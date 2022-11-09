<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MuayThaiClass>
 */
class MuayThaiClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $max_member = fake()->numberBetween(10,100);
        $status = ['available', 'unavailable'];
        return [
            'max_member' => $max_member,
            'enrolled_member' => fake()->numberBetween(0, $max_member),
            'status' => $status[array_rand($status)],
            'total_class_hour' => fake()->numberBetween(4, 12),
            'open_date' => now()->subSeconds(fake()->numberBetween(100, 10000)),
            'close_date' => now()->subSeconds(fake()->numberBetween(100, 10000)),
            'price' => fake()->numberBetween(1000,8000),
        ];
    }
}
