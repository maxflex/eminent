<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::value('id'),
            'title' => fake()->realText(20),
            'comment' => fake()->realText(),
            'penalty' => mt_rand(1, 10) >= 8 ? null : fake()->numberBetween(1, 100),
            'is_finished' => mt_rand(1, 10) >= 8 ? 1 : 0,
        ];
    }
}
