<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('headers')->insert([
            'content' => "Bonjour bienvenue sur hotel artichaut",
            'image' => "headers/1740404402.jpg",
            'created_at' => now(),
            'updated_at' => now(),

        ]);
    }
}
