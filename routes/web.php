<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::delete('/logout', [DashboardController::class, 'index'])->name('logout');
    Route::resource('authors', AuthorController::class);
    Route::resource('genres', GenreController::class);
    Route::resource('menus', MenuController::class);
    Route::get('/users/admin', [UserController::class, 'showAdmins'])->name('users.admin');
    Route::get('/users/poster', [UserController::class, 'showPosters'])->name('users.poster');
    Route::get('/users/banned', [UserController::class, 'showBanneds'])->name('users.banned');
    Route::get('/users/{user}/create-ban', [UserController::class, 'createBan'])->name('users.create_ban');
    Route::post('/users/{user}/create-ban', [UserController::class, 'storeBan'])->name('users.store_ban');
    Route::get('/users/{user}/edit-ban', [UserController::class, 'editBan'])->name('users.edit_ban');
    Route::patch('/users/{user}/edit-ban', [UserController::class, 'updateBan'])->name('users.update_ban');
    Route::delete('/users/{user}/unban', [UserController::class, 'unban'])->name('users.unban');
    Route::get('/users/{user}/edit-role', [UserController::class, 'editRole'])->name('users.edit_role');
    Route::patch('/users/{user}/update-role', [UserController::class, 'updateRole'])->name('users.update_role');
    Route::resource('users', UserController::class);
    Route::get('/articles/{article}/show-chapters', [ChapterController::class, 'index'])->name('articles.show_chapters');
    Route::get('/articles/{article}/create-chapter', [ChapterController::class, 'create'])->name('articles.create_chapter');
    Route::post('/articles/{article}/store-chapter', [ChapterController::class, 'store'])->name('articles.store_chapter');
    Route::get('/articles/{article}/edit-chapter/{chapter}', [ChapterController::class, 'edit'])->name('articles.edit_chapter');
    Route::patch('/articles/{article}/update-chapter/{chapter}', [ChapterController::class, 'update'])->name('articles.update_chapter');
    Route::delete('/articles/{article}/destroy-chapter/{chapter}', [ChapterController::class, 'destroy'])->name('articles.destroy_chapter');
    Route::patch('/articles/{article}/change-status/{status}', [ArticleController::class, 'updateStatus'])->name('articles.change_status');
    Route::patch('/articles/{article}/change-complete-status', [ArticleController::class, 'updateCompleteStatus'])->name('articles.change_complete_status');
    Route::resource('articles', ArticleController::class);
});
