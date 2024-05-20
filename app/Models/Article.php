<?php

namespace App\Models;

use App\Enums\ArticleCompleteStatus;
use App\Enums\ArticleStatus;
use App\Scopes\ApprovedArticleScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();
        if (!is_route('admin.*')) {
            static::addGlobalScope(new ApprovedArticleScope());
        }
    }

    protected $fillable = ['title', 'description', 'user_id', 'cover_image'];

    protected function getCompletedTextAttribute()
    {
        $value = $this->is_completed;
        return ArticleCompleteStatus::from($value)->label();
    }

    protected function getStatusTextAttribute()
    {
        $value = $this->status;
        return ArticleStatus::from($value)->label();
    }

    protected function getViewTextAttribute()
    {
        $value = $this->view;
        return $value.' lượt xem';
    }

    protected function getChaptersTextAttribute()
    {
        $value = $this->chapters->count();
        return $value.' chương';
    }

    protected function getNewestChapterAttribute(): ?Chapter
    {
        $newestChapterNumber = $this->chapters->max('number');
        $newestChapter = $this->chapters
            ->where('number', $newestChapterNumber)
            ->first();
        if (!empty($newestChapter)) {
            return $newestChapter;
        } else {
            return null;
        }
    }

    protected function getFirstChapterAttribute(): ?Chapter
    {
        $firstChapterNumber = $this->chapters()->min('number');
        $firstChapter = $this->chapters
            ->where('number', $firstChapterNumber)
            ->first();
        if (!empty($firstChapter)) {
            return $firstChapter;
        } else {
            return null;
        }
    }

    protected function getCreatedAtTextAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    protected function getUpdatedAtTextAttribute()
    {
        return $this->updated_at->diffForHumans();
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function authors(
    ): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'articles_authors',
            'article_id', 'author_id');
    }

    public function genres(
    ): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'articles_genres',
            'article_id', 'genre_id');
    }

    public function chapters(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Chapter::class, 'article_id', 'id');
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class, 'article_id', 'id');
    }

    public function bookmarks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Bookmark::class, 'article_id', 'id');
    }

    public function getBookmarkForCurrentUser() : ?Bookmark
    {
        // Lấy bookmark của bài viết hiện tại cho người dùng đang đăng nhập
        $bookmark = Auth::user()->bookmarks()->where('article_id', $this->id)->first();

        return $bookmark; // Nếu không tìm thấy bookmark nó sẽ trả về null mặc định
    }

    public static function getHotArticles(
    ): \Illuminate\Database\Eloquent\Builder
    {
        return self::query()
            ->orderByDesc('view');
    }

    public static function getNewUpdateArticles(
    ): \Illuminate\Database\Eloquent\Builder
    {
        return self::query()
            ->orderByDesc('updated_at');
    }

    public static function getCompletedArticles(
    ): \Illuminate\Database\Eloquent\Builder
    {
        return self::query()
            ->where('is_completed', ArticleCompleteStatus::COMPLETED)
            ->orderByDesc('updated_at');
    }

    public function getNewestChapters($size
    ): \Illuminate\Database\Eloquent\Relations\HasMany {
        return self::chapters()->orderByDesc('number')->take($size);
    }

    public function getNewestCommentsPaginate($perPage = 10
    ): \Illuminate\Contracts\Pagination\LengthAwarePaginator {
        return self::comments()->orderByDesc('updated_at')
            ->paginate($perPage, ['*'], 'comment_page');
    }

    public function increaseViewCount()
    {
        $this->timestamps = false;
        $this->increment('view');
        $this->save();
        $this->timestamps = true;
    }
}
