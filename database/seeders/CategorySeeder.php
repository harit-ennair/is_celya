<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => "L'Art du Cheveu",
                'description' => 'Coiffure, coupes modernes, brushings et rituels capillaires sur-mesure.',
            ],
            [
                'name' => 'Nuances',
                'description' => 'Colorations personnalisées, balayages d\'exception et reflets lumière.',
            ],
            [
                'name' => 'Beauté des Ongles & Soins des Mains',
                'description' => 'Manucures russes, pédicures spa, vernis permanents et extensions d\'ongles.',
            ],
            [
                'name' => "L'Art de l'Épilation",
                'description' => 'Épilation délicate du visage et du corps pour une peau douce et impeccable.',
            ],
            [
                'name' => 'Regard & Sublimation',
                'description' => 'Extensions de cils, brow lift, lash lift et soins révélateurs du regard.',
            ],
            [
                'name' => 'Rituels Visage & Art du Maquillage',
                'description' => 'Soins du visage experts, hydra facial et mise en beauté maquillage haute précision.',
            ],
            // Product boutique categories
            [
                'name' => 'Soins du Visage',
                'description' => 'Produits haut de gamme pour sublimer votre peau au quotidien.',
            ],
            [
                'name' => 'Soins du Corps',
                'description' => 'Laits, huiles et gommages pour prendre soin de votre silhouette.',
            ],
            [
                'name' => 'Aromathérapie',
                'description' => 'Bougies de massage et brumes bien-être relaxantes.',
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::updateOrCreate(
                ['name' => $categoryData['name']],
                ['description' => $categoryData['description']]
            );
        }
    }
}
