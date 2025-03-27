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
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('guest_id')->nullable();
            $table->unsignedBigInteger('room_id');

            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->integer('quantity')->nullable();
            $table->timestamp('payment_method')->nullable();
            $table->timestamp('payment_status')->nullable();
            $table->enum('status', ['Pending', 'Accepted', 'Rejected'])->default('Pending');

            $table->timestamps();

            // Clés étrangères
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('set null');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
