<?php

namespace App\Models;

use App\Scopes\ApprovedArticleScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected function getCreatedAtTextAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    protected function getUpdatedAtTextAttribute()
    {
        return $this->updated_at->diffForHumans();
    }

    public function article(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
