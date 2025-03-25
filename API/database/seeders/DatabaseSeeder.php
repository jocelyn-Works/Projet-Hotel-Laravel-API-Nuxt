<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(HeaderSeeder::class);
        $this->call(HotelSeeder::class);
        $this->call(MainSeeder::class);
        $this->call(SocialSeeder::class);
        $this->call(TypeRoomSeeder::class);
        $this->call(RoomSeeder::class);

    }
}
