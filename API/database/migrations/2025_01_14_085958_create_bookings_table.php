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
            $table->foreignUuid(\App\Models\User::class);
            $table->foreignUuid(\App\Models\Guest::class);
            $table->foreignUuid(\App\Models\Room::class);
            $table->timestamp('started_at');
            $table->timestamp('ended_at');
            $table->integer('quantity')->nullable();
            $table->timestamp('payment_method');
            $table->timestamp('payment_status');
            $table->enum('status', ['Pending', 'Accepted', 'Rejected'])->default('Pending');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
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
