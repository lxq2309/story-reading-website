<?php

namespace App\Models;

use App\Enums\ArticleCompleteStatus;
use App\Enums\ArticleStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'user_id'];

    protected function getCompletedTextAttribute($value)
    {
        return ArticleCompleteStatus::from($value)->label();
    }

    protected function getStatusTextAttribute($value)
    {
        return ArticleStatus::from($value)->label();
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
}
