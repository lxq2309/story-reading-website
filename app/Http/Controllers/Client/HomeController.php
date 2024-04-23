<?php

namespace App\Http\Controllers\Client;

use App\Enums\ArticleCompleteStatus;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $hotArticles = Article::getHotArticles()->take(16)->get();
        $newUpdateArticles = Article::getNewUpdateArticles()->take(30)->get();
        $completedArticles = Article::getCompletedArticles()->take(12)->get();
        return view('client.home.index', [
            'hotArticles' => $hotArticles,
            'newUpdateArticles' => $newUpdateArticles,
            'completedArticles' => $completedArticles,
        ]);
    }

    public function showHotArticles()
    {
        $hotArticles = Article::getHotArticles()->paginate();
        return view('client.articles.index', [
            'articles' => $hotArticles,
            'title' => 'Truyện đọc nhiều nhất',
            'description' => 'Danh sách những truyện đang hot, có nhiều người đọc và quan tâm nhất trong tháng này',
        ]);
    }

    public function showNewUpdateArticles()
    {
        $newUpdateArticles = Article::getNewUpdateArticles()->paginate();
        return view('client.articles.index', [
            'articles' => $newUpdateArticles,
            'title' => 'Truyện mới cập nhật',
            'description' => 'Danh sách truyện chữ được cập nhật (vừa ra mắt, thêm chương mới, sửa nội dung,..) gần đây.',
        ]);
    }

    public function showCompletedArticles()
    {
        $completedArticles = Article::getCompletedArticles()->paginate();
        return view('client.articles.index', [
            'articles' => $completedArticles,
            'title' => 'Truyện đã hoàn thành',
            'description' => 'Danh sách những truyện đã hoàn thành, ra đủ chương.',
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $articles = Article::query()->where('title', 'like', '%' . $keyword . '%')->paginate();
        return view('client.articles.index', [
            'articles' => $articles,
            'title' => 'Tìm kiếm cho từ khoá "' . $keyword . '"',
            'description' => 'Danh sách truyện có liên quan tới từ khoá "' . $keyword . '"',
        ]);
    }
}
