<?php

namespace App\Http\Requests\Article;

use App\Models\Article;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreArticleRequest extends ArticleBaseRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                Rule::unique(Article::class),
            ],
        ];
    }
}
