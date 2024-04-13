<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $all)
 */
class Author extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'description'];
}
