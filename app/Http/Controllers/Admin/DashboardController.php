<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Author;
use App\Models\Genre;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $articleCount = Article::count();
        $authorCount = Author::count();
        $genreCount = Genre::count();
        $userCount = User::count();
        return view('admin.dashboard.index', [
            'articleCount' => $articleCount,
            'authorCount' => $authorCount,
            'genreCount' => $genreCount,
            'userCount' => $userCount,
        ]);
    }
}
