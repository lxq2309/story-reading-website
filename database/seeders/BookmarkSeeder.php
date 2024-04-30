<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Bookmark;
use App\Models\Chapter;
use App\Models\User;
use Database\Factories\ChapterFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function (User $user) {
            $articles = Article::inRandomOrder()->take(rand(1, 10))->get();
            foreach ($articles as $article) {
                $bookmark = new Bookmark();
                $bookmark->user_id = $user->id;
                $bookmark->article_id = $article->id;
                $bookmark->name = $article->title;
                $bookmark->description = 'Bookmarked ' . $article->title;
                $bookmark->is_public = rand(0, 1);
                $bookmark->save();
            }
        });
    }

}
