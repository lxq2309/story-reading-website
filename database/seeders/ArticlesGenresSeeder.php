<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticlesGenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::all()->each(function (Article $article) {
            // Lấy ngẫu nhiên một hoặc hai thể loại
            $genres = Genre::inRandomOrder()->take(rand(1, 5))->get();
            // Gắn kết thể loại với bài viết
            $article->genres()->attach($genres->pluck('id'));
        });
    }
}
