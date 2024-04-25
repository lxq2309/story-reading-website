<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Chapter;
use Database\Factories\ChapterFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::all()->each(function (Article $article) {
            ChapterFactory::$sequence = 1;
            Chapter::factory()->count(100)->create(['article_id' => $article->id]);
        });
    }

}
