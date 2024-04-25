<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chapter>
 */
class ChapterFactory extends Factory
{
    public static $sequence = 1;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => self::$sequence++,
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'view' => $this->faker->randomDigit(),
            'article_id' => null,
        ];
    }
}
