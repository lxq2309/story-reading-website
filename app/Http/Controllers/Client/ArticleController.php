<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Nette\Utils\Paginator;

class ArticleController extends Controller
{
    public function show(Article $article)
    {
        $article->increaseViewCount();
        $chapters = $article->chapters()->paginate();
        $comments = $article->getNewestCommentsPaginate();
        return view('client.articles.show', [
            'article' => $article,
            'chapters' => $chapters,
            'comments' => $comments,
        ]);
    }
}
