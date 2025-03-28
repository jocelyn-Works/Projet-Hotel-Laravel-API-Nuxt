<?php

namespace Database\Seeders;


namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Import de la classe DB

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'name' => 'Formule demi-pension (soir)',
                'description' => ' / personne/ jour',
                'price' => 75.00,
            ],
            [
                'name' => 'Formule pension complète (midi+soir)',
                'description' => ' / personne / jour',
                'price' => 150.00,
            ],
            [
                'name' => 'Formule petit déjeuner (matin)',
                'description' => '/ personne/ jour',
                'price' => 45.00,
            ],
            [
                'name' => 'Service de pressing tout-compris',
                'description' => ' / personne / jour',
                'price' => 250.00,
            ],
            [
                'name' => 'Pack High Tech',
                'description' => ' / semaine, mise à disposition d’un ordinateur personnel, batteries externes, chargeurs sans fil dans la chambre et autres services.',
                'price' => 100.00,
            ],
            [
                'name' => 'Internet Fibre haut débit',
                'description' => ' en une fois',
                'price' => 25.00,
            ],
            [
                'name' => 'Accès illimité au SPA et massages',
                'description' => ' / Semaine',
                'price' => 400.00,
            ],
            [
                'name' => 'Service voiturier',
                'description' => ' / jour. Le client devra entrer sa plaque d’immatriculation pour une meilleure reconnaissance du véhicule.',
                'price' => 45.00,
            ],
            [
                'name' => 'All Inclusive',
                'description' => 'Tous les services inclus. Le tarif sera négocié avec le client lors du check-out.',
                'price' => 0.00,
            ],
        ]);
    }
}
