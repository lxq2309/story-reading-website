<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'number', 'article_id'];
    protected $perPage = 50;

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

    protected function getPreviousAttribute()
    {
        $value = $this->number;
        $previousNumber = $value - 1;
        $previousChapter = Chapter::query()->where('article_id', $this->article_id)->where('number', $previousNumber)->first();
        return $previousChapter;
    }

    protected function getNextAttribute()
    {
        $value = $this->number;
        $nextNumber = $value + 1;
        $nextChapter = Chapter::query()->where('article_id', $this->article_id)->where('number', $nextNumber)->first();
        return $nextChapter;
    }
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

    public function increaseViewCount()
    {
        $this->timestamps = false;
        $this->increment('view');
        $this->save();
        $this->timestamps = true;
    }
}
