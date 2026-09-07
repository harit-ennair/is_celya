<?php

use App\Enums\AppointmentStatus;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Enums\Role;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

test('enums have expected cases and values', function () {
    expect(Role::Admin->value)->toBe('admin')
        ->and(Role::Customer->value)->toBe('customer')
        ->and(AppointmentStatus::Pending->value)->toBe('pending')
        ->and(AppointmentStatus::Confirmed->value)->toBe('confirmed')
        ->and(AppointmentStatus::Completed->value)->toBe('completed')
        ->and(AppointmentStatus::Cancelled->value)->toBe('cancelled')
        ->and(AppointmentStatus::NoShow->value)->toBe('no_show')
        ->and(OrderStatus::Pending->value)->toBe('pending')
        ->and(OrderStatus::Processing->value)->toBe('processing')
        ->and(OrderStatus::Completed->value)->toBe('completed')
        ->and(OrderStatus::Cancelled->value)->toBe('cancelled')
        ->and(OrderStatus::Refunded->value)->toBe('refunded')
        ->and(PaymentStatus::Pending->value)->toBe('pending')
        ->and(PaymentStatus::Paid->value)->toBe('paid')
        ->and(PaymentStatus::Failed->value)->toBe('failed')
        ->and(PaymentStatus::Refunded->value)->toBe('refunded');
});

test('user model has uuid, attributes, casts and relationships', function () {
    $user = User::factory()->create([
        'first_name' => 'Alice',
        'last_name' => 'Dupont',
        'role' => Role::Customer,
        'is_active' => true,
    ]);

    expect(Str::isUuid($user->id))->toBeTrue()
        ->and($user->first_name)->toBe('Alice')
        ->and($user->last_name)->toBe('Dupont')
        ->and($user->role)->toBe(Role::Customer)
        ->and($user->is_active)->toBeTrue()
        ->and($user->appointments)->toBeEmpty()
        ->and($user->orders)->toBeEmpty();
});

test('service model has uuid, casts and appointments relationship', function () {
    $service = Service::factory()->create([
        'name' => 'Massage Relaxant',
        'price' => 75.50,
        'duration' => 60,
        'image_path' => 'services/massage.jpg',
        'is_active' => true,
    ]);

    expect(Str::isUuid($service->id))->toBeTrue()
        ->and($service->price)->toBe('75.50')
        ->and($service->duration)->toBe(60)
        ->and($service->is_active)->toBeTrue()
        ->and($service->appointments)->toBeEmpty();
});

test('category and product models have relationships and casts', function () {
    $category = Category::factory()->create([
        'name' => 'Soins Visage',
        'description' => 'Produits pour le visage',
    ]);

    $product = Product::factory()->create([
        'category_id' => $category->id,
        'name' => 'Crème de jour',
        'price' => 29.99,
        'stock_quantity' => 15,
        'image_path' => 'products/creme.jpg',
        'is_active' => true,
    ]);

    expect(Str::isUuid($category->id))->toBeTrue()
        ->and(Str::isUuid($product->id))->toBeTrue()
        ->and($category->products)->toHaveCount(1)
        ->and($category->products->first()->id)->toBe($product->id)
        ->and($product->category->id)->toBe($category->id)
        ->and($product->price)->toBe('29.99')
        ->and($product->stock_quantity)->toBe(15)
        ->and($product->is_active)->toBeTrue();
});

test('appointment model links user and service with proper enum status', function () {
    $user = User::factory()->create();
    $service = Service::factory()->create(['price' => 50.00]);

    $appointment = Appointment::factory()->confirmed()->create([
        'user_id' => $user->id,
        'service_id' => $service->id,
        'price' => 50.00,
        'appointment_at' => now()->addDays(2),
        'notes' => 'Client régulier',
    ]);

    expect(Str::isUuid($appointment->id))->toBeTrue()
        ->and($appointment->status)->toBe(AppointmentStatus::Confirmed)
        ->and($appointment->user->id)->toBe($user->id)
        ->and($appointment->service->id)->toBe($service->id)
        ->and($appointment->price)->toBe('50.00')
        ->and($user->appointments)->toHaveCount(1)
        ->and($service->appointments)->toHaveCount(1);
});

test('order and order item models link users, products and handle casts', function () {
    $user = User::factory()->create();
    $product1 = Product::factory()->create(['price' => 20.00]);
    $product2 = Product::factory()->create(['price' => 30.00]);

    $order = Order::factory()->completed()->create([
        'user_id' => $user->id,
        'order_number' => 'ORD-TEST-001',
        'total' => 70.00,
        'order_date' => '2026-09-01',
    ]);

    $item1 = OrderItem::factory()->create([
        'order_id' => $order->id,
        'product_id' => $product1->id,
        'quantity' => 2,
        'unit_price' => 20.00,
    ]);

    $item2 = OrderItem::factory()->create([
        'order_id' => $order->id,
        'product_id' => $product2->id,
        'quantity' => 1,
        'unit_price' => 30.00,
    ]);

    expect(Str::isUuid($order->id))->toBeTrue()
        ->and(Str::isUuid($item1->id))->toBeTrue()
        ->and($order->status)->toBe(OrderStatus::Completed)
        ->and($order->payment_status)->toBe(PaymentStatus::Paid)
        ->and($order->user->id)->toBe($user->id)
        ->and($order->orderItems)->toHaveCount(2)
        ->and($user->orders)->toHaveCount(1)
        ->and($item1->order->id)->toBe($order->id)
        ->and($item1->product->id)->toBe($product1->id)
        ->and($item1->quantity)->toBe(2)
        ->and($item1->unit_price)->toBe('20.00')
        ->and($product1->orderItems)->toHaveCount(1);
});

test('foreign key cascades function properly on delete', function () {
    $user = User::factory()->create();
    $service = Service::factory()->create();
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);

    $appointment = Appointment::factory()->create([
        'user_id' => $user->id,
        'service_id' => $service->id,
    ]);

    $order = Order::factory()->create(['user_id' => $user->id]);
    $item = OrderItem::factory()->create([
        'order_id' => $order->id,
        'product_id' => $product->id,
    ]);

    // Deleting user should cascade delete appointment and order
    $user->delete();
    expect(Appointment::find($appointment->id))->toBeNull()
        ->and(Order::find($order->id))->toBeNull()
        ->and(OrderItem::find($item->id))->toBeNull();

    // Deleting category should cascade delete product
    $category->delete();
    expect(Product::find($product->id))->toBeNull();
});
