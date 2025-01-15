<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'quantity' => $this->faker->randomDigit(),
            'payment_method' => $this->faker->word(),
            'payment_status' => $this->faker->word(),
            'status' => $this->faker->word(),
            'created_at' => now(),
            'updated_at' => now(),
            'qr_code' => Str::random(10),
            'is_all_inclusive' => $this->faker->boolean(),
            'licence_plate' => Str::random(10),

        ];
    }
}
