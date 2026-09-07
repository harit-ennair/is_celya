<?php

use App\Enums\AppointmentStatus;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Enums\Role;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('user controller handles CRUD, filtering, formatting, and status toggling', function () {
    $user = User::factory()->create([
        'first_name' => 'Sara',
        'last_name' => 'Alami',
        'role' => Role::Customer,
        'is_active' => true,
    ]);

    // Index
    $res = $this->getJson(route('users.index'));
    $res->assertOk()
        ->assertJsonFragment(['full_name' => 'Sara Alami', 'is_admin' => false]);

    // Store
    $storeRes = $this->postJson(route('users.store'), [
        'first_name' => 'Nour',
        'last_name' => 'Bennani',
        'email' => 'nour@example.com',
        'password' => 'secret12345',
        'role' => Role::Admin->value,
    ]);
    $storeRes->assertCreated()
        ->assertJsonFragment(['full_name' => 'Nour Bennani', 'is_admin' => true]);

    $createdUser = User::where('email', 'nour@example.com')->first();
    expect($createdUser)->not->toBeNull();

    // Toggle status
    $toggleRes = $this->patchJson(route('users.toggle-status', $createdUser));
    $toggleRes->assertOk()->assertJsonFragment(['is_active' => false]);
    expect($createdUser->fresh()->is_active)->toBeFalse();

    // Destroy
    $deleteRes = $this->deleteJson(route('users.destroy', $createdUser));
    $deleteRes->assertOk();
    expect(User::find($createdUser->id))->toBeNull();
});

test('service controller handles creation with image, price/duration, and status toggling', function () {
    Storage::fake('public');

    $image = UploadedFile::fake()->image('soin.jpg');

    $res = $this->postJson(route('services.store'), [
        'name' => 'Massage aux Pierres Chaudes',
        'description' => 'Soin relaxant',
        'price' => 89.90,
        'duration' => 75,
        'image' => $image,
    ]);

    $res->assertCreated();
    $serviceId = $res->json('service.id');
    $service = Service::find($serviceId);

    expect($service)->not->toBeNull()
        ->and($res->json('service.image_url'))->toContain('services/');

    // Toggle status
    $toggleRes = $this->patchJson(route('services.toggle-status', $service));
    $toggleRes->assertOk()->assertJsonFragment(['is_active' => false]);
    expect($service->fresh()->is_active)->toBeFalse();
});

test('category and product controllers handle catalog and stock operations', function () {
    $category = Category::factory()->create(['name' => 'Corps']);

    // Create Product via ProductController
    $res = $this->postJson(route('products.store'), [
        'category_id' => $category->id,
        'name' => 'Lait Corps Hydratant',
        'price' => 24.50,
        'stock_quantity' => 20,
    ]);

    $res->assertCreated();
    $productId = $res->json('product.id');
    $product = Product::find($productId);

    // Update Stock via controller action
    $stockRes = $this->patchJson(route('products.update-stock', $product), [
        'quantity' => 5,
        'action' => 'subtract',
    ]);
    $stockRes->assertOk()->assertJsonFragment(['current_stock' => 15]);
    expect($product->fresh()->stock_quantity)->toBe(15);

    // Categories index includes products count
    $catRes = $this->getJson(route('categories.index'));
    $catRes->assertOk()
        ->assertJsonFragment(['name' => 'Corps', 'products_count' => 1]);
});

test('appointment controller validates service availability, sets price, and manages workflow', function () {
    $user = User::factory()->create();
    $activeService = Service::factory()->create(['price' => 65.00, 'is_active' => true]);
    $inactiveService = Service::factory()->inactive()->create(['price' => 50.00]);

    // Attempt booking inactive service -> fails with 422
    $failRes = $this->postJson(route('appointments.store'), [
        'user_id' => $user->id,
        'service_id' => $inactiveService->id,
        'appointment_at' => now()->addDays(2)->toDateTimeString(),
    ]);
    $failRes->assertStatus(422);

    // Book active service -> price is derived and status is Pending
    $res = $this->postJson(route('appointments.store'), [
        'user_id' => $user->id,
        'service_id' => $activeService->id,
        'appointment_at' => now()->addDays(3)->toDateTimeString(),
        'notes' => 'Première visite',
    ]);

    $res->assertCreated();
    $appointment = Appointment::find($res->json('appointment.id'));
    expect($appointment->price)->toBe('65.00')
        ->and($appointment->status)->toBe(AppointmentStatus::Pending);

    // Workflow actions: Confirm, Complete, Cancel
    $this->patchJson(route('appointments.confirm', $appointment))->assertOk();
    expect($appointment->fresh()->status)->toBe(AppointmentStatus::Confirmed);

    $this->patchJson(route('appointments.complete', $appointment))->assertOk();
    expect($appointment->fresh()->status)->toBe(AppointmentStatus::Completed);

    $this->patchJson(route('appointments.cancel', $appointment))->assertOk();
    expect($appointment->fresh()->status)->toBe(AppointmentStatus::Cancelled);
});

test('order controller checks stock, deducts quantity, calculates total, and restores stock on cancel', function () {
    $user = User::factory()->create();
    $prod1 = Product::factory()->create(['price' => 10.00, 'stock_quantity' => 10, 'is_active' => true]);
    $prod2 = Product::factory()->create(['price' => 25.00, 'stock_quantity' => 5, 'is_active' => true]);

    // Attempt order with excessive stock -> 422
    $failRes = $this->postJson(route('orders.store'), [
        'user_id' => $user->id,
        'items' => [
            ['product_id' => $prod1->id, 'quantity' => 15],
        ],
    ]);
    $failRes->assertStatus(422);

    // Valid order: 2 * prod1 (20) + 2 * prod2 (50) = 70 total
    $orderRes = $this->postJson(route('orders.store'), [
        'user_id' => $user->id,
        'items' => [
            ['product_id' => $prod1->id, 'quantity' => 2],
            ['product_id' => $prod2->id, 'quantity' => 2],
        ],
    ]);

    $orderRes->assertCreated();
    $orderId = $orderRes->json('order.id');
    $order = Order::find($orderId);

    expect($order)->not->toBeNull()
        ->and($order->total)->toBe('70.00')
        ->and($order->status)->toBe(OrderStatus::Pending)
        ->and($order->payment_status)->toBe(PaymentStatus::Pending)
        ->and($prod1->fresh()->stock_quantity)->toBe(8)
        ->and($prod2->fresh()->stock_quantity)->toBe(3);

    // Update statuses
    $this->patchJson(route('orders.update-status', $order), [
        'status' => OrderStatus::Processing->value,
    ])->assertOk();
    expect($order->fresh()->status)->toBe(OrderStatus::Processing);

    $this->patchJson(route('orders.update-payment-status', $order), [
        'payment_status' => PaymentStatus::Paid->value,
    ])->assertOk();
    expect($order->fresh()->payment_status)->toBe(PaymentStatus::Paid);

    // Cancel order -> restores stock
    $cancelRes = $this->postJson(route('orders.cancel', $order));
    $cancelRes->assertOk();

    expect($order->fresh()->status)->toBe(OrderStatus::Cancelled)
        ->and($prod1->fresh()->stock_quantity)->toBe(10)
        ->and($prod2->fresh()->stock_quantity)->toBe(5);
});
