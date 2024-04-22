<?php

namespace App\Http\Controllers;

use App\Enums\ArticleStatus;
use App\Http\Requests\Article\ChangeStatusRequest;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $articles = article::query()->orderByDesc("id");
        if ($request->has('search')) {
            $searchText = $request->input('search');
            $articles->where('title', 'like', '%'.$searchText.'%');
        }

        $articles = $articles->paginate();
        return view('admin.articles.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $article = new Article();
        $authors = Author::all();
        $genres = Genre::all();
        return view('admin.articles.create', [
            'article' => $article,
            'authors' => $authors,
            'genres' => $genres,
            'selectedGenres' => array(),
            'selectedAuthors' => array(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $request->validated();
        $validateData = $request->all();
        $validateData['user_id'] = 299;
        $article = Article::create($validateData);
        $article->genres()->attach($validateData['genres']);
        $article->authors()->attach($validateData['authors']);
        return redirect()->route('admin.articles.index')
            ->with('success', 'Tạo truyện thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $authors = Author::all();
        $genres = Genre::all();
        $selectedGenres = $article->genres->pluck('id')->toArray();
        $selectedAuthors = $article->authors->pluck('id')->toArray();
        return view('admin.articles.edit', [
            'article' => $article,
            'authors' => $authors,
            'genres' => $genres,
            'selectedGenres' => $selectedGenres,
            'selectedAuthors' => $selectedAuthors,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $request->validated();
        $validateData = $request->all();
        $article->update($validateData);

        if (!empty($validateData['genres'])) {
            $article->genres()->sync($validateData['genres']);
        } else {
            $article->genres()->detach();
        }

        if (!empty($validateData['authors'])) {
            $article->authors()->sync($validateData['authors']);
        } else {
            $article->authors()->detach();
        }

        return redirect()->route('admin.articles.index')
            ->with('success', 'Sửa thông tin truyện thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index')
            ->with('success', 'Xoá truyện thành công!');
    }

    public function updateStatus(
        Article $article,
        $status
    ) {
        if (!validateArticleStatus($status)) {
            return redirect()->route('admin.articles.index');
        }
        if ($article->status != ArticleStatus::HIDDEN->label()) {
            $statusText = mb_strtolower(ArticleStatus::from($status)->label());
        } else {
            $statusText = "đã được hiển thị lại";
        }

        $message = 'Truyện "'.$article->title.'" '.$statusText.'!';

        $article->status = $status;
        $article->save();
        return redirect()->route('admin.articles.index')
            ->with('success', $message);
    }

    public function updateCompleteStatus(Article $article)
    {
        $article->is_completed = !$article->is_completed;
        $article->save();
        if ($article->is_completed) {
            $message = 'Thay đổi trạng thái thành đã hoàn thành thành công!';
        }
        else
        {
            $message = 'Thay đổi trạng thái thành chưa hoàn thành thành công!';
        }
        return redirect()->route('admin.articles.index')->with('success', $message);
    }
}
