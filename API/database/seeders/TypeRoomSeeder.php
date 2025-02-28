<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typeId = DB::table('types')->insertGetId([
            'name' => "Nos Suite",
            'description' => "Découvrez le luxe ultime dans notre suite de luxe. Située au dernier étage de notre hôtel, cette suite exclusive offre une vue panoramique, une piscine privée, un sauna et une terrasse ensoleillée.",
            'price' => 3000,
            'created_at' => now(),
            'updated_at' => now(),

        ]);

        // Insérer les images associées
        $images = [
            "typeRoom/OdSX9Q2lu4.jpg",
            "typeRoom/krg7STUF1t.webp",
            "typeRoom/4mDbMYL5O1.webp",
            "typeRoom/mE4OUzpShg.webp"
        ];

        foreach ($images as $image) {
            DB::table('image_type')->insert([
                'type_id' => $typeId,
                'image' => $image,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        $typeId = DB::table('types')->insertGetId([
            'name' => "Chambre de luxe",
            'description' => "Découvrez le luxe ultime dans notre suite de luxe. Située au dernier étage de notre hôtel, cette suite exclusive offre une vue panoramique, une piscine privée, un sauna et une terrasse ensoleillée.",
            'price' => 4000,
            'created_at' => now(),
            'updated_at' => now(),

        ]);

        // Insérer les images associées
        $images = [
            "typeRoom/xhnVrEpafe.webp",
            "typeRoom/9xw4y95ttZ.webp",
            "typeRoom/pBoMTDlgWw.webp",
            "typeRoom/yZnqmagS8p.webp"
        ];

        foreach ($images as $image) {
            DB::table('image_type')->insert([
                'type_id' => $typeId,
                'image' => $image,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }



        $typeId = DB::table('types')->insertGetId([
            'name' => "Chambre Standard",
            'description' => "Découvrez le luxe ultime dans notre suite de luxe. Située au dernier étage de notre hôtel, cette suite exclusive offre une vue panoramique, une piscine privée, un sauna et une terrasse ensoleillée.",
            'price' => 2000,
            'created_at' => now(),
            'updated_at' => now(),

        ]);

        // Insérer les images associées
        $images = [
            "typeRoom/q9yPvGbSbx.webp",
            "typeRoom/0ZZdYFglGi.jpg",
            "typeRoom/xfYUXo4qia.webp",
            "typeRoom/SfQdHfkiir.webp"
        ];

        foreach ($images as $image) {
            DB::table('image_type')->insert([
                'type_id' => $typeId,
                'image' => $image,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


    }
}
