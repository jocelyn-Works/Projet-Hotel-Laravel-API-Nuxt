<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hotels')->insert([
            'name' => "L’Artichaut",
            'street' => "42 avenue Gabriel, 75008",
            'city' => "PARIS",
            'phone_number' => "+33 45 45 45 45",
            'email' => "artichaut@email.com",
            'image' => "hotel/1740404101.png",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
