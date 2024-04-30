<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
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
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function changeInfo(Request $request): View
    {
        return view('client.users.change-info', [
            'user' => $request->user(),
        ]);
    }

    public function showPostedArticles(User $user): View
    {
        $articles = $user->articles()->paginate();
        return view('client.users.posted-articles', [
            'articles' => $articles,
            'user' => $user,
        ]);
    }

    public function showBookmarks(User $user): View
    {
        $bookmarks = $user->bookmarks()->paginate();
        return view('client.users.bookmarks', [
            'bookmarks' => $bookmarks,
            'user' => $user,
        ]);
    }

    public function changePassword(Request $request): View
    {
        return view('client.users.change-password', [
            'user' => $request->user(),
        ]);
    }
}
