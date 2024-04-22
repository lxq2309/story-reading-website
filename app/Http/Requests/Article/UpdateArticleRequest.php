<?php

namespace App\Http\Requests\Article;

use App\Models\Article;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateArticleRequest extends ArticleBaseRequest
{
    public function rules(): array
    {
        $id = $this->route('article');
        return [
            'title' => [
                'required',
                Rule::unique(Article::class)->ignore($id),
            ],
        ];
    }
}
