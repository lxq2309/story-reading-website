<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name', 'description'];
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'articles_genres', 'article_id', 'genre_id');
    }
}
