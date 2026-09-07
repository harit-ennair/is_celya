<?php

namespace Database\Seeders;

use App\Enums\AppointmentStatus;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Enums\Role;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Administrator
        $admin = User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'Celya',
            'email' => 'admin@celya.com',
            'phone' => '+33123456789',
            'password' => Hash::make('password'),
            'role' => Role::Admin,
            'is_active' => true,
        ]);

        // 2. Create Demo Customer
        $demoCustomer = User::factory()->create([
            'first_name' => 'Sophie',
            'last_name' => 'Martin',
            'email' => 'customer@celya.com',
            'phone' => '+33987654321',
            'password' => Hash::make('password'),
            'role' => Role::Customer,
            'is_active' => true,
        ]);

        // 3. Additional Customers
        $customers = User::factory(4)->create([
            'role' => Role::Customer,
        ]);

        $allCustomers = collect([$demoCustomer])->merge($customers);

        // 4. Create Services
        $servicesData = [
            [
                'name' => 'Soin Visage Hydratant Express',
                'description' => 'Un soin rapide et efficace pour revitaliser et réhydrater votre peau en profondeur.',
                'price' => 45.00,
                'duration' => 30,
                'image_path' => 'services/visage-express.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Massage Relaxant aux Huiles Essentielles',
                'description' => 'Un moment de pure détente pour relâcher les tensions musculaires et apaiser le corps et l\'esprit.',
                'price' => 75.00,
                'duration' => 60,
                'image_path' => 'services/massage-relaxant.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Soin Signature Celya Anti-Âge',
                'description' => 'Notre rituel anti-âge d\'exception stimulant le collagène pour un teint lissé et éclatant.',
                'price' => 120.00,
                'duration' => 90,
                'image_path' => 'services/soin-anti-age.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Rituel Bien-Être & Gommage Corps',
                'description' => 'Gommage aux cristaux marins suivi d\'une hydratation intense pour une peau douce et soyeuse.',
                'price' => 85.00,
                'duration' => 60,
                'image_path' => 'services/rituel-corps.jpg',
                'is_active' => true,
            ],
        ];

        $services = collect($servicesData)->map(fn (array $data) => Service::create($data));

        // 5. Create Categories & Products
        $categoriesData = [
            [
                'name' => 'Soins du Visage',
                'description' => 'Produits haut de gamme pour sublimer votre peau au quotidien.',
                'products' => [
                    [
                        'name' => 'Crème Hydratante Éclat Bio',
                        'description' => 'Soin hydratant riche en antioxydants naturels pour une peau douce toute la journée.',
                        'price' => 34.50,
                        'stock_quantity' => 25,
                        'image_path' => 'products/creme-hydratante.jpg',
                    ],
                    [
                        'name' => 'Sérum Régénérant Vitamine C',
                        'description' => 'Sérum booster de luminosité anti-taches et anti-fatigue.',
                        'price' => 48.00,
                        'stock_quantity' => 18,
                        'image_path' => 'products/serum-vitamine-c.jpg',
                    ],
                ],
            ],
            [
                'name' => 'Soins du Corps',
                'description' => 'Laits, huiles et gommages pour prendre soin de votre silhouette.',
                'products' => [
                    [
                        'name' => 'Huile Précieuse Nourrissante',
                        'description' => 'Mélange d\'huiles végétales pures pour nourrir intensément peau et cheveux.',
                        'price' => 29.90,
                        'stock_quantity' => 30,
                        'image_path' => 'products/huile-precieuse.jpg',
                    ],
                    [
                        'name' => 'Gommage Sucré Énergisant',
                        'description' => 'Exfoliant corporel gourmand aux extraits d\'agrumes.',
                        'price' => 22.00,
                        'stock_quantity' => 40,
                        'image_path' => 'products/gommage-sucre.jpg',
                    ],
                ],
            ],
            [
                'name' => 'Aromathérapie',
                'description' => 'Bougies de massage et brumes bien-être relaxantes.',
                'products' => [
                    [
                        'name' => 'Brume d\'Oreiller Sérénité',
                        'description' => 'À la lavande fine et camomille pour favoriser un sommeil réparateur.',
                        'price' => 18.50,
                        'stock_quantity' => 50,
                        'image_path' => 'products/brume-oreiller.jpg',
                    ],
                ],
            ],
        ];

        $allProducts = collect();

        foreach ($categoriesData as $catData) {
            $category = Category::create([
                'name' => $catData['name'],
                'description' => $catData['description'],
            ]);

            foreach ($catData['products'] as $prodData) {
                $product = $category->products()->create([
                    'name' => $prodData['name'],
                    'description' => $prodData['description'],
                    'price' => $prodData['price'],
                    'stock_quantity' => $prodData['stock_quantity'],
                    'image_path' => $prodData['image_path'],
                    'is_active' => true,
                ]);

                $allProducts->push($product);
            }
        }

        // 6. Create Appointments
        foreach ($allCustomers as $customer) {
            $service = $services->random();
            Appointment::create([
                'user_id' => $customer->id,
                'service_id' => $service->id,
                'appointment_at' => now()->addDays(rand(1, 14))->setHour(rand(9, 17))->setMinute(0),
                'price' => $service->price,
                'status' => AppointmentStatus::Confirmed,
                'notes' => 'Rendez-vous réservé en ligne.',
            ]);
        }

        // 7. Create Orders with OrderItems
        foreach ($allCustomers as $customer) {
            $order = Order::create([
                'user_id' => $customer->id,
                'order_number' => 'ORD-'.date('Ymd').'-'.strtoupper(substr(uniqid(), -4)),
                'total' => 0,
                'status' => OrderStatus::Completed,
                'payment_status' => PaymentStatus::Paid,
                'order_date' => now()->subDays(rand(1, 10))->toDateString(),
                'notes' => 'Commande livrée à domicile.',
            ]);

            $selectedProducts = $allProducts->random(rand(1, 2));
            $total = 0;

            foreach ($selectedProducts as $product) {
                $qty = rand(1, 2);
                $unitPrice = $product->price;
                $total += $qty * $unitPrice;

                $order->orderItems()->create([
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'unit_price' => $unitPrice,
                ]);
            }

            $order->update(['total' => $total]);
        }
    }
}
