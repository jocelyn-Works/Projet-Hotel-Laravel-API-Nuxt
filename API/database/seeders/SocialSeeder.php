<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('socials')->insert([
            "icon" => "socials/1740405526.svg",
            "url" => "www.facebook.com",
            'created_at' => now(),
            'updated_at' => now(),

        ]);

        DB::table('socials')->insert([
            "icon" => "socials/1740405626.svg",
            "url" => "www.instagram.com",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('socials')->insert([
            "icon" => "socials/1740405669.svg",
            "url" => "www.tiktok.com",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
