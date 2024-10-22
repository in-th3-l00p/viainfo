<?php

namespace Database\Factories\Classroom;

use App\Models\Classroom\Classroom;
use App\Models\Classroom\ClassroomEvent;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classroom\ClassroomEvent>
 */
class ClassroomEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $classroom = Classroom::query()->inRandomOrder()->first();
        $teacher = $classroom->teachers()->inRandomOrder()->first();
        $start = fake()->dateTimeBetween('now', '+2 days');
        $end = Carbon::instance($start)->addHours(fake()->numberBetween(3, 6));

        return [
            'name' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'start' => $start,
            'end' => $end,
            'self_attend' => fake()->boolean(),
            'attend_code' => Str::random(10),
            'owner_id' => $teacher->id,
            'classroom_id' => $classroom->id,
        ];
    }
}
