<?php

namespace App\Http\Requests\Admin\Article;

use App\Models\Article;
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
