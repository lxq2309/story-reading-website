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
        $chaptersPaginate = $article->chapters()->paginate();
        return view('client.articles.show', [
            'article' => $article,
            'chaptersPaginate' => $chaptersPaginate,
        ]);
    }
}
