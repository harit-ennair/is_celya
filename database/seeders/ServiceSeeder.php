<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriesWithServices = [
            [
                'category' => "L'Art du Cheveu",
                'description' => 'Coiffure, coupes modernes, brushings et rituels capillaires sur-mesure.',
                'services' => [
                    ['name' => 'Shampoing', 'price' => 20.00, 'duration' => 15, 'description' => 'Shampoing traitant doux suivi d\'un rinçage soigné.'],
                    ['name' => 'Shampoing spécifique + masque', 'price' => 50.00, 'duration' => 25, 'description' => 'Shampoing spécifique adapté à la nature du cheveu et masque nourrissant.'],
                    ['name' => 'Brushing', 'price' => 50.00, 'duration' => 30, 'description' => 'Brushing classique pour cheveux courts.'],
                    ['name' => 'Brushing cheveux mi-longs', 'price' => 70.00, 'duration' => 40, 'description' => 'Brushing professionnel pour cheveux mi-longs.'],
                    ['name' => 'Brushing cheveux très longs', 'price' => 80.00, 'duration' => 50, 'description' => 'Brushing soigné pour cheveux longs à très longs.'],
                    ['name' => 'Brushing wavy', 'price' => 100.00, 'duration' => 45, 'description' => 'Brushing ondulé moderne style wavy glamour.'],
                    ['name' => 'Pointes', 'price' => 70.00, 'duration' => 20, 'description' => 'Rafraîchissement et égalisation des pointes.'],
                    ['name' => 'Coupe enfant', 'price' => 80.00, 'duration' => 30, 'description' => 'Coupe soignée et adaptée pour enfants.'],
                    ['name' => 'Demi-coupe', 'price' => 120.00, 'duration' => 35, 'description' => 'Restructuration partielle de la coupe.'],
                    ['name' => 'Coupe', 'price' => 150.00, 'duration' => 45, 'description' => 'Coupe complète personnalisée selon la morphologie du visage.'],
                    ['name' => 'Babyliss', 'price' => 100.00, 'duration' => 45, 'description' => 'Bouclage ou lissage haute précision au fer Babyliss.'],
                    ['name' => 'Extensions de cheveux', 'price' => 100.00, 'duration' => 60, 'description' => 'À partir de 100 DH — Pose et ajustement d\'extensions capillaires naturelles.'],
                    ['name' => 'Soin capillaire L\'Oréal', 'price' => 250.00, 'duration' => 45, 'description' => 'Rituel de soin profond professionnel L\'Oréal Professionnel.'],
                    ['name' => 'Soin capillaire Selerm / Wella / K18', 'price' => 300.00, 'duration' => 60, 'description' => 'Traitement réparateur moléculaire de pointe (Selerm, Wella ou K18).'],
                    ['name' => 'Lissage', 'price' => 1000.00, 'duration' => 180, 'description' => 'À partir de 1000 DH — Lissage professionnel longue durée.'],
                ],
            ],
            [
                'category' => 'Nuances',
                'description' => 'Colorations personnalisées, balayages d\'exception et reflets lumière.',
                'services' => [
                    ['name' => 'Coloration racine', 'price' => 250.00, 'duration' => 60, 'description' => 'À partir de 250 DH — Retouche des repousses et harmonisation de la couleur.'],
                    ['name' => 'Coloration racine sans ammoniaque', 'price' => 300.00, 'duration' => 60, 'description' => 'À partir de 300 DH — Coloration racine douce sans ammoniaque respectant le cuir chevelu.'],
                    ['name' => 'Plex color - balayage', 'price' => 350.00, 'duration' => 90, 'description' => 'À partir de 350 DH — Technique Plex protectrice pour éclaircissement et balayage.'],
                    ['name' => 'Coloration', 'price' => 400.00, 'duration' => 90, 'description' => 'À partir de 400 DH — Coloration globale uniforme et brillante.'],
                    ['name' => 'Coloration sans ammoniaque', 'price' => 450.00, 'duration' => 90, 'description' => 'À partir de 450 DH — Coloration complète haute brillance sans ammoniaque.'],
                    ['name' => 'Balayage', 'price' => 800.00, 'duration' => 150, 'description' => 'À partir de 800 DH — Balayage sur-mesure pour un effet fondu et lumineux naturel.'],
                ],
            ],
            [
                'category' => 'Beauté des Ongles & Soins des Mains',
                'description' => 'Manucures russes, pédicures spa, vernis permanents et extensions d\'ongles.',
                'services' => [
                    ['name' => 'Pose vernis', 'price' => 60.00, 'duration' => 20, 'description' => 'Application d\'un vernis classique couleur ou french.'],
                    ['name' => 'Manucure', 'price' => 80.00, 'duration' => 35, 'description' => 'Soin complet des ongles et cuticules des mains avec limage et polissage.'],
                    ['name' => 'Pédicure', 'price' => 120.00, 'duration' => 45, 'description' => 'Soin complet des pieds avec gommage et mise en beauté des ongles.'],
                    ['name' => 'Pose permanente', 'price' => 150.00, 'duration' => 45, 'description' => 'Pose de vernis semi-permanent longue tenue.'],
                    ['name' => 'Pédicure spa', 'price' => 170.00, 'duration' => 60, 'description' => 'Rituel de détente spa complet pour les pieds avec masque et bain hydratant.'],
                    ['name' => 'Smart pédicure (sèche)', 'price' => 200.00, 'duration' => 60, 'description' => 'Pédicure médicale sèche à l\'appareil avec disques Smart innovants.'],
                    ['name' => 'Manucure + permanente', 'price' => 200.00, 'duration' => 60, 'description' => 'Soin des mains complet combiné à une pose de vernis semi-permanent.'],
                    ['name' => 'Pédicure + permanente', 'price' => 250.00, 'duration' => 75, 'description' => 'Pédicure soignée avec pose de vernis semi-permanent longue durée.'],
                    ['name' => 'Manucure russe + permanente', 'price' => 250.00, 'duration' => 75, 'description' => 'Manucure combinée haute précision à la ponceuse et vernis semi-permanent.'],
                    ['name' => 'Renforcement', 'price' => 250.00, 'duration' => 60, 'description' => 'Gainage et renforcement de l\'ongle naturel fragilisé.'],
                    ['name' => 'Faux ongle + permanente', 'price' => 250.00, 'duration' => 90, 'description' => 'Pose de capsules / faux ongles suivie d\'une finition semi-permanente.'],
                    ['name' => 'Remplissage gel / résine', 'price' => 300.00, 'duration' => 75, 'description' => 'Entretien et comblement de la repousse en gel ou résine.'],
                    ['name' => 'BIAB / we care', 'price' => 300.00, 'duration' => 60, 'description' => 'Builder In A Bottle — Gel de construction nourrissant pour fortifier les ongles.'],
                    ['name' => 'Gel BIAB extension', 'price' => 450.00, 'duration' => 90, 'description' => 'Extension d\'ongles au gel de construction BIAB.'],
                    ['name' => 'Dépose permanente', 'price' => 50.00, 'duration' => 20, 'description' => 'Retrait doux et soigné du vernis semi-permanent.'],
                    ['name' => 'Dépose gel ou BIAB', 'price' => 100.00, 'duration' => 30, 'description' => 'Dépose complète sans abîmer la plaque unguéale naturelle.'],
                    ['name' => 'Réparation ongle / ongle cassé', 'price' => 50.00, 'duration' => 15, 'description' => 'Réparation unitaire d\'un ongle cassé ou fissuré.'],
                ],
            ],
            [
                'category' => "L'Art de l'Épilation",
                'description' => 'Épilation délicate du visage et du corps pour une peau douce et impeccable.',
                'services' => [
                    ['name' => 'Duvet', 'price' => 30.00, 'duration' => 10, 'description' => 'Épilation précise de la lèvre supérieure.'],
                    ['name' => 'Sourcils', 'price' => 30.00, 'duration' => 15, 'description' => 'Épilation et restructuration de la ligne des sourcils.'],
                    ['name' => 'Menton', 'price' => 30.00, 'duration' => 10, 'description' => 'Épilation douce de la zone du menton.'],
                    ['name' => 'Aisselles', 'price' => 40.00, 'duration' => 15, 'description' => 'Épilation nette et apaisante des aisselles.'],
                    ['name' => 'Demi-jambes', 'price' => 50.00, 'duration' => 25, 'description' => 'Épilation des demi-jambes (du genou aux chevilles).'],
                    ['name' => 'Demi-bras', 'price' => 50.00, 'duration' => 20, 'description' => 'Épilation des avant-bras.'],
                    ['name' => 'Bord de maillot', 'price' => 50.00, 'duration' => 20, 'description' => 'Épilation classique du pourtour du maillot.'],
                    ['name' => 'Bras', 'price' => 70.00, 'duration' => 30, 'description' => 'Épilation complète des bras.'],
                    ['name' => 'Dos', 'price' => 70.00, 'duration' => 30, 'description' => 'Épilation de la zone du dos.'],
                    ['name' => 'Jambes entières', 'price' => 100.00, 'duration' => 40, 'description' => 'Épilation intégrale des jambes de la cuisse aux chevilles.'],
                    ['name' => 'Maillot intégral', 'price' => 100.00, 'duration' => 30, 'description' => 'Épilation maillot échancré ou intégral à la cire chaude.'],
                    ['name' => 'Visage entier', 'price' => 100.00, 'duration' => 30, 'description' => 'Épilation complète de l\'ensemble des zones du visage.'],
                    ['name' => 'Épilation complète (jambes entières, aisselles, maillot intégral)', 'price' => 250.00, 'duration' => 75, 'description' => 'Forfait beauté complète : jambes entières, aisselles et maillot intégral.'],
                ],
            ],
            [
                'category' => 'Regard & Sublimation',
                'description' => 'Extensions de cils, brow lift, lash lift et soins révélateurs du regard.',
                'services' => [
                    ['name' => 'Cils normal', 'price' => 100.00, 'duration' => 30, 'description' => 'Pose de faux cils à effet naturel.'],
                    ['name' => 'Coloration des sourcils', 'price' => 100.00, 'duration' => 20, 'description' => 'Teinture personnalisée pour intensifier la ligne des sourcils.'],
                    ['name' => 'Dépose cils', 'price' => 100.00, 'duration' => 25, 'description' => 'Retrait doux et sécurisé des extensions de cils.'],
                    ['name' => 'Brow lift', 'price' => 300.00, 'duration' => 45, 'description' => 'Rehaussement et fixation des poils des sourcils pour un effet structuré et fourni.'],
                    ['name' => 'Lash lift', 'price' => 300.00, 'duration' => 45, 'description' => 'Rehaussement naturel des cils pour une courbure spectaculaire.'],
                    ['name' => 'Cils permanent', 'price' => 400.00, 'duration' => 90, 'description' => 'À partir de 400 DH — Extensions de cils cil à cil ou volume russe.'],
                ],
            ],
            [
                'category' => 'Rituels Visage & Art du Maquillage',
                'description' => 'Soins du visage experts, hydra facial et mise en beauté maquillage haute précision.',
                'services' => [
                    ['name' => 'Soin éclat', 'price' => 300.00, 'duration' => 60, 'description' => 'Rituel Visage — Soin coup d\'éclat express détoxifiant et illuminateur.'],
                    ['name' => 'Soin anti-âge', 'price' => 300.00, 'duration' => 60, 'description' => 'Rituel Visage — Soin raffermissant lissant les ridules et tonifiant l\'ovale du visage.'],
                    ['name' => 'Hydra facial', 'price' => 400.00, 'duration' => 60, 'description' => 'Rituel Visage — Nettoyage en profondeur, micro-dermabrasion et hydratation aux sérums.'],
                    ['name' => 'Maquillage du jour', 'price' => 500.00, 'duration' => 45, 'description' => 'Art du Maquillage — Teint frais, lumineux et naturel parfait pour la journée.'],
                    ['name' => 'Maquillage soirée', 'price' => 800.00, 'duration' => 60, 'description' => 'Art du Maquillage — Maquillage sophistiqué haute tenue et glamour pour soirées.'],
                    ['name' => 'Pack fiancée', 'price' => 1200.00, 'duration' => 120, 'description' => 'Art du Maquillage — Mise en beauté complète, maquillage d\'exception et coiffure de fiançailles.'],
                    ['name' => 'Pack mariée', 'price' => 2500.00, 'duration' => 180, 'description' => 'Art du Maquillage — Prestation d\'exception pour la mariée : maquillage haute couture, coiffure et retouches.'],
                ],
            ],
        ];

        foreach ($categoriesWithServices as $group) {
            $category = Category::firstOrCreate(
                ['name' => $group['category']],
                ['description' => $group['description']]
            );

            foreach ($group['services'] as $serviceData) {
                Service::updateOrCreate(
                    ['name' => $serviceData['name']],
                    [
                        'category_id' => $category->id,
                        'description' => $serviceData['description'],
                        'price' => $serviceData['price'],
                        'duration' => $serviceData['duration'],
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}
