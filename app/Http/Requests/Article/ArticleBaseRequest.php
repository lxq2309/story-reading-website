<?php

namespace App\Http\Requests\Article;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class ArticleBaseRequest extends BaseRequest
{
    public function attributes()
    {
        return [
            'title' => 'Tên truyện',
        ];
    }
}
