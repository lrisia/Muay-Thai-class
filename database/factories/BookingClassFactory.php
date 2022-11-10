<?php

namespace Database\Factories;

use App\Models\MuayThaiClass;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookingClass>
 */
class BookingClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $status = ['in_progress', 'accepted', 'declined', 'paid'];
        return [
            'muay_thai_class_id' => MuayThaiClass::inRandomOrder()->first()->id,
            'user_id' => User::where( 'role', 'USER')->inRandomOrder()->first()->id,
            'status' => $status[array_rand($status)]
        ];
    }
}
