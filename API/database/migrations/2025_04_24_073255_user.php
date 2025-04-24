<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // à changer pour un mot de passe plus sûr !
            'phone' => '0601020304',
            'address' => '123 Rue de l’Admin, 75000 Paris',
            'is_admin' => true,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('users')->where('email', 'admin@email.com')->delete();
    }
};
