<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Order::with(['user', 'orderItems.product']);

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->query('user_id'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->query('status'));
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->query('payment_status'));
        }

        if ($request->filled('order_number')) {
            $query->where('order_number', 'like', "%{$request->query('order_number')}%");
        }

        $orders = $query->latest()->paginate(15);

        return response()->json([
            'data' => $orders,
            'pagination' => [
                'total' => $orders->total(),
                'per_page' => $orders->perPage(),
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
            ],
        ]);
    }

    /**
     * Store a newly created order and its items in storage with stock deduction.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string'],
        ]);

        $order = DB::transaction(function () use ($validated) {
            $total = 0.0;
            $itemsToCreate = [];

            foreach ($validated['items'] as $itemData) {
                /** @var Product $product */
                $product = Product::lockForUpdate()->findOrFail($itemData['product_id']);

                if (! $product->is_active) {
                    throw ValidationException::withMessages([
                        'items' => "The product '{$product->name}' is no longer active.",
                    ]);
                }

                if ($product->stock_quantity < $itemData['quantity']) {
                    throw ValidationException::withMessages([
                        'items' => "Insufficient stock for '{$product->name}'. Available: {$product->stock_quantity}.",
                    ]);
                }

                // Deduct stock
                $product->decrement('stock_quantity', $itemData['quantity']);

                $unitPrice = (float) $product->price;
                $lineTotal = $unitPrice * $itemData['quantity'];
                $total += $lineTotal;

                $itemsToCreate[] = [
                    'product_id' => $product->id,
                    'quantity' => $itemData['quantity'],
                    'unit_price' => $unitPrice,
                ];
            }

            $order = Order::create([
                'user_id' => $validated['user_id'],
                'order_number' => 'ORD-'.date('Ymd').'-'.strtoupper(Str::random(6)),
                'total' => $total,
                'status' => OrderStatus::Pending,
                'payment_status' => PaymentStatus::Pending,
                'order_date' => now()->toDateString(),
                'notes' => $validated['notes'] ?? null,
            ]);

            foreach ($itemsToCreate as $item) {
                $order->orderItems()->create($item);
            }

            return $order;
        });

        $order->load(['user', 'orderItems.product']);

        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order,
        ], 201);
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order): JsonResponse
    {
        $order->load(['user', 'orderItems.product']);

        return response()->json([
            'order' => $order,
        ]);
    }

    /**
     * Update the order status.
     */
    public function updateStatus(Request $request, Order $order): JsonResponse
    {
        $validated = $request->validate([
            'status' => ['required', new Enum(OrderStatus::class)],
        ]);

        $order->update(['status' => $validated['status']]);

        return response()->json([
            'message' => 'Order status updated successfully',
            'order' => $order,
        ]);
    }

    /**
     * Update the order payment status.
     */
    public function updatePaymentStatus(Request $request, Order $order): JsonResponse
    {
        $validated = $request->validate([
            'payment_status' => ['required', new Enum(PaymentStatus::class)],
        ]);

        $order->update(['payment_status' => $validated['payment_status']]);

        return response()->json([
            'message' => 'Payment status updated successfully',
            'order' => $order,
        ]);
    }

    /**
     * Cancel the order and restore product stocks.
     */
    public function cancel(Order $order): JsonResponse
    {
        if ($order->status === OrderStatus::Cancelled) {
            return response()->json([
                'message' => 'Order is already cancelled',
            ], 422);
        }

        DB::transaction(function () use ($order) {
            // Restore stocks
            foreach ($order->orderItems as $item) {
                Product::where('id', $item->product_id)->increment('stock_quantity', $item->quantity);
            }

            $order->update(['status' => OrderStatus::Cancelled]);
        });

        return response()->json([
            'message' => 'Order cancelled and stock restored successfully',
            'order' => $order->fresh(),
        ]);
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order): JsonResponse
    {
        $order->delete();

        return response()->json([
            'message' => 'Order deleted successfully',
        ]);
    }
}
