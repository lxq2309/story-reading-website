<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Chapter\StoreChapterRequest;
use App\Http\Requests\Admin\Chapter\UpdateChapterRequest;
use App\Models\Article;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Article $article)
    {
        $chapters = $article->chapters()->orderByDesc("number");
        if ($request->has('search')) {
            $searchText = $request->input('search');
            $chapters->where('title', 'like', '%'.$searchText.'%');
        }

        $chapters = $chapters->paginate();
        return view('admin.chapters.index', [
            'article' => $article,
            'chapters' => $chapters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Article $article)
    {
        $chapter = new Chapter();
        if ($article->chapters->count() == 0) {
            $newestChapterNumber = 1;
        } else {
            $newestChapterNumber = $article->chapters->max('number') + 1;
        }
        $chapter->number = $newestChapterNumber;
        return view('admin.chapters.create', [
            'article' => $article,
            'chapter' => $chapter,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChapterRequest $request, Article $article)
    {
        $request->validated();
        $validateData = $request->all();
        $validateData['article_id'] = $article->id;
        $chapter = Chapter::create($validateData);
        $article->setUpdatedAt(now());
        $article->save();
        return redirect()->route('admin.articles.show_chapters', $article->id)
            ->with('success', 'Thêm chương mới thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chapter $chapter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article, Chapter $chapter)
    {
        return view('admin.chapters.edit', [
            'chapter' => $chapter,
            'article' => $article,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateChapterRequest $request,
        Article $article,
        Chapter $chapter
    ) {
        $request->validated();
        $validateData = $request->all();
        $chapter->update($validateData);
        return redirect()->route('admin.articles.show_chapters', $article->id)
            ->with('success', 'Sửa thông tin chương thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article, Chapter $chapter)
    {
        $chapter->delete();
        return redirect()->route('admin.articles.show_chapters', $article->id)
            ->with('success', 'Xoá chương thành công!');
    }
}
