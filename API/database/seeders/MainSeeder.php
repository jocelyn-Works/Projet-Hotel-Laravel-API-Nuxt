<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mains')->insert([
            'content' => "Situé au cœur de Paris, L’Artichaut est bien plus qu'un simple hôtel c'est une expérience unique où luxe et confort se rencontrent",
            'image' => "mains/1740404958.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('mains')->insert([
            'content' => "Plongez dans un univers de sérénité et de bien-être au spa de L’Artichaut. Notre espace dédié à la relaxation vous propose une gamme complète de soins personnalisés, conçus pour apaiser votre corps et votre esprit.",
            'image' => "mains/1740405074.webp",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('mains')->insert([
            'content' => "À L’Artichaut, chaque moment est une invitation à la découverte et au plaisir. Notre restaurant vous propose une cuisine raffinée, mettant en avant des produits frais et de saison, dans une ambiance chaleureuse et conviviale.",
            'image' => "mains/1740405255.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
