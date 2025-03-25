<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $types = DB::table('types')->get();

        foreach ($types as $type) {
            for ($i = 1; $i <= 4; $i++) {
                DB::table('rooms')->insert([
                    'number' => ($type->id * 100) + $i, // ex: 101, 201, 301
                    'type_id' => $type->id,
                    'quantity' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
