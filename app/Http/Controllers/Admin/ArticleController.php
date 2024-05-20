<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ArticleStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Article\StoreArticleRequest;
use App\Http\Requests\Admin\Article\UpdateArticleRequest;
use App\Http\Requests\Article\ChangeStatusRequest;
use App\Models\Article;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentUser = Auth::user();
        // if currentUser is Admin
        if ($currentUser->is_admin) {
            $articles = Article::query();
        } else {
            // else currentUser is Poster
            $articles = $currentUser->articles();
        }
        $articles->orderByDesc("id");
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
        $currentUser = Auth::user();
        $validateData['user_id'] = $currentUser->id;
        // Xử lý lưu tệp tải lên
        $validateData = $this->uploadCoverImage($request, $validateData);
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
        // Xử lý lưu tệp tải lên
        $validateData = $this->uploadCoverImage($request, $validateData);
        // Ngăn không cho cập nhật giá trị của trường updated_at = now
        $article->timestamps = false;
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

        // Bật lại chức năng tự động cập nhật trường updated_at để không ảnh hưởng tới các chức năng khác
        $article->timestamps = false;

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
        } else {
            $message = 'Thay đổi trạng thái thành chưa hoàn thành thành công!';
        }
        return redirect()->route('admin.articles.index')
            ->with('success', $message);
    }

    /**
     * @param  UpdateArticleRequest  $request
     * @param  array  $validateData
     *
     * @return array
     */
    private function uploadCoverImage(
        UpdateArticleRequest $request,
        array $validateData
    ): array {
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $imageName = time().'-'.$image->getClientOriginalName();
            $image->move(public_path('images/articles'), $imageName);
            $validateData['cover_image'] = '/images/articles/'.$imageName;
        } else {
            if ($validateData['cover_image_url']) {
                $validateData['cover_image'] = $validateData['cover_image_url'];
            } else {
                $validateData['cover_image'] = '/images/articles/default.jpg';
            }
        }
        return $validateData;
    }
}
