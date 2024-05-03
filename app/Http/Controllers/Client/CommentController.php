<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $request->validate([
            'content' => 'required|min:3',
        ]);
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->article_id = $article->id;
        $comment->content = $request->get('content');
        $comment->save();
        return redirect()->back()->with('success', 'Gửi bình luận thành công!');
    }

    public function destroy(Article $article, Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', 'Xoá bình luận thành công!');
    }
}
