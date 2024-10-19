<?php

namespace Database\Factories\Contact;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact\ContactSubmission>
 */
class ContactSubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "first_name" => fake()->firstName(),
            "last_name" => fake()->lastName(),
            "email" => fake()->email(),
            "phone_number" => fake()->phoneNumber(),
            "message" => fake()->paragraph(),
            "created_at" => fake()->dateTimeBetween("-30days", now())
        ];
    }
}
