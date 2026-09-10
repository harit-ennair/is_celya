<?php

use App\Models\Category;
use App\Models\Service;
use Database\Seeders\CategorySeeder;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\ServiceSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('category and service seeders populate expected salon catalog', function () {
    $this->seed(CategorySeeder::class);
    $this->seed(ServiceSeeder::class);

    $expectedCategories = [
        "L'Art du Cheveu" => 15,
        'Nuances' => 6,
        'Beauté des Ongles & Soins des Mains' => 17,
        "L'Art de l'Épilation" => 13,
        'Regard & Sublimation' => 6,
        'Rituels Visage & Art du Maquillage' => 7,
    ];

    foreach ($expectedCategories as $categoryName => $servicesCount) {
        $category = Category::where('name', $categoryName)->first();

        expect($category)->not->toBeNull()
            ->and($category->services)->toHaveCount($servicesCount);
    }

    // Check specific services and prices
    $shampoing = Service::where('name', 'Shampoing')->first();
    expect($shampoing)->not->toBeNull()
        ->and((float) $shampoing->price)->toBe(20.00)
        ->and($shampoing->category->name)->toBe("L'Art du Cheveu");

    $lissage = Service::where('name', 'Lissage')->first();
    expect($lissage)->not->toBeNull()
        ->and((float) $lissage->price)->toBe(1000.00);

    $balayage = Service::where('name', 'Balayage')->first();
    expect($balayage)->not->toBeNull()
        ->and((float) $balayage->price)->toBe(800.00)
        ->and($balayage->category->name)->toBe('Nuances');

    $packMariee = Service::where('name', 'Pack mariée')->first();
    expect($packMariee)->not->toBeNull()
        ->and((float) $packMariee->price)->toBe(2500.00)
        ->and($packMariee->category->name)->toBe('Rituels Visage & Art du Maquillage');
});

test('database seeder runs completely with all relations', function () {
    $this->seed(DatabaseSeeder::class);

    expect(Category::count())->toBeGreaterThanOrEqual(6)
        ->and(Service::count())->toBe(64);
});
