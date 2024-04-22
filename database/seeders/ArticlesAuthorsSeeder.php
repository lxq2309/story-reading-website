<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticlesAuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::all()->each(function (Article $article) {
            // Lấy ngẫu nhiên một hoặc hai tác giả
            $authors = Author::inRandomOrder()->take(rand(1, 5))->get();
            // Gắn kết tác giả với bài viết
            $article->authors()->attach($authors->pluck('id'));
        });
    }
}
