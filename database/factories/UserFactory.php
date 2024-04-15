<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->unique()->userName(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'address' => fake()->address(),
            'password' => static::$password ??= Hash::make('password'),
            'date_of_birth' => fake()->dateTimeBetween('-30 years', '-18 years'),
            'avatar' => fake()->text,
            'description' => fake()->text,
            'gender' => rand(0, 1),
            'remember_token' => Str::random(10),
            'created_at' => fake()->dateTimeBetween('-30 years', '-18 years'),
            'updated_at' => fake()->dateTimeBetween('-30 years', '-18 years'),
            'role' => rand(0, 2),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
