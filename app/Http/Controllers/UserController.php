<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Article;
use App\Models\BannedUser;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use function PHPUnit\Framework\returnCallback;

class UserController extends Controller
{
    public function show($id = null)
    {
        if (is_null($id)) {
            $user = Auth::user();
        } else {
            if ($id == Auth::id()) {
                return redirect()->route('users.show', null);
            }
            $user = User::query()->find($id);
            if (is_null($user)) {
                return redirect()->route('users.show', null);
            }
        }
        return view('client.users.general', [
            'user' => $user,
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->validated();
        $user = $request->user();
        $validatedData = $request->all();
        if($request->hasfile('avatar')) {
            $image = $request->file('avatar');
            $imageName = $user->id . '.' . $image->extension();
            $image->move(public_path('images/users'), $imageName);
            $validatedData['avatar'] = '/images/users/' . $imageName;
        }
        $request->user()->fill($validatedData);
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return redirect()->route('users.change_info')
            ->with('status', 'Cập nhật thông tin tài khoản thành công!');
    }

    public function changeInfo(Request $request): View
    {
        return view('client.users.change-info', [
            'user' => $request->user(),
        ]);
    }

    public function showPostedArticles(User $user): View
    {
        $articles = $user->articles()->orderByDesc('updated_at')->paginate();
        return view('client.users.posted-articles', [
            'articles' => $articles,
            'user' => $user,
        ]);
    }

    public function showBookmarks(User $user): View
    {
        $bookmarks = $user->bookmarks()
            ->whereHas(lcfirst(class_basename(Article::class)))
            ->orderByDesc('updated_at')
            ->paginate();
        return view('client.users.bookmarks', [
            'bookmarks' => $bookmarks,
            'user' => $user,
        ]);
    }

    public function showComments(User $user): View
    {
        $comments = $user->comments()
            ->whereHas(lcfirst(class_basename(Article::class)))
            ->orderByDesc('created_at')->paginate();
        return view('client.users.comments', [
            'comments' => $comments,
            'user' => $user,
        ]);
    }

    public function changePassword(Request $request): View
    {
        return view('client.users.change-password', [
            'user' => $request->user(),
        ]);
    }

    public function handleBanned(Request $request)
    {
        $bannedUser = $request->user()->banned;
        if (!$bannedUser) {
            return redirect()->route('home.index');
        }
        return view('client.users.banned', [
            'bannedUser' => $bannedUser,
        ]);
    }
}
