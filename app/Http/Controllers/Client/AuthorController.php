<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function show(Author $author)
    {
        $articles = $author->articles()->paginate();
        return view('client.articles.index', [
            'articles' => $articles,
            'title' => 'Tác giả ' . $author->name,
            'description' => $author->description,
        ]);
    }
}
