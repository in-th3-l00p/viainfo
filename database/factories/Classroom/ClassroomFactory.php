<?php

namespace Database\Factories\Classroom;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Classroom>
 */
class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->name(),
            "slug" => fake()->slug(),
            "description" => fake()->paragraph(),
            "owner_id" => User::query()
                ->where("role", "admin")
                ->inRandomOrder()
                ->first()
        ];
    }
}
