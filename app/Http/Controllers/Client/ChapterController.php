<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function show(Article $article, $number)
    {
        $chapter = $article->chapters()->where('number', $number)->first();
        if (empty($chapter)) {
            abort(404);
        }
        $chapter->increaseViewCount();
        $article->increaseViewCount();
        $comments = $article->getNewestCommentsPaginate();
        return view('client.chapters.show', [
            'article' => $article,
            'chapter' => $chapter,
            'articleChapters' => $article->chapters()->orderBy('number', 'desc')->get(),
            'user' => $article->user,
            'comments' => $comments,
        ]);
    }
}
