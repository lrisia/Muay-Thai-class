<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $arr = array("Waiting", "Received", "Progress", "Completed", "Return");
        return [
//            'user_id' => User::inRandomOrder()->first()->id,
//            'title' => fake()->realText(30),
//            'description' => fake()->realText(200),
//            'view_count' => fake()->numberBetween(0, 100000),
//            'like_count' => fake()->numberBetween(0, 50000),
//            'organization_id' => Organization::inRandomOrder()->first()->id,
//            'status' => $arr[array_rand($arr)]
        ];
    }
}
