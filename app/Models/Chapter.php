<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'number', 'article_id'];

    protected function getViewTextAttribute(): string
    {
        $value = $this->view;
        return $value.' lượt xem';
    }

    protected function getNumberTextAttribute()
    {
        $value = $this->number;
        return 'Chương '.$value;
    }

    public function article(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }
}
