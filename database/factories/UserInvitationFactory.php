<?php

namespace Database\Factories;

use App\Models\Classroom\Classroom;
use App\Models\User;
use App\Models\UserInvitation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserInvitationFactory extends Factory
{
    protected $model = UserInvitation::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'classroom_name' => null,
            'invited_by' => User::factory(),
            'sent' => fake()->boolean(),
            'token' => Str::uuid(),
        ];
    }

    public function withClassroom(): self
    {
        return $this->state(function (array $attributes) {
            $classroom = Classroom::query()->inRandomOrder()->first();
            return [
                'classroom_name' => $classroom ? $classroom->name : 'Default Classroom',
            ];
        });
    }

    public function withoutClassroom(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'classroom_name' => null,
            ];
        });
    }
}
