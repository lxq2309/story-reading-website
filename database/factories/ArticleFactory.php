<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'is_completed' => $this->faker->boolean(),
            'cover_image' => $this->faker->imageUrl(),
            'view' => $this->faker->randomDigit(),
            'status' => rand(0, 1),
        ];
    }
}
