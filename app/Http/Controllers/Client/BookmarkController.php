<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $validatedData = $request->all();
        $validatedData['user_id'] = Auth::id();
        $validatedData['article_id'] = $article->id;
        $bookmark = Bookmark::create($validatedData);
        $bookmark->save();
        return redirect()->back()->with('bookmark_success', 'Thêm bookmark thành công!');
    }

    public function destroy(Article $article, Bookmark $bookmark)
    {
        $bookmark->delete();
        return redirect()->back()->with('bookmark_success', 'Xoá bookmark thành công!');
    }
}
