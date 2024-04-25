<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function show(Genre $genre)
    {
        $articles = $genre->articles()->paginate();
        return view('client.articles.index', [
            'articles' => $articles,
            'title' => 'Thể loại ' . $genre->name,
            'description' => $genre->description,
        ]);
    }
}
