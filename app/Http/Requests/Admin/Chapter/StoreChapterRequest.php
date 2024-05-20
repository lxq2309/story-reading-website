<?php

namespace App\Http\Requests\Admin\Chapter;

use App\Models\Chapter;
use Illuminate\Validation\Rule;

class StoreChapterRequest extends ChapterBaseRequest
{
    public function rules(): array
    {
        $articleId = $this->route()->parameter('article')->id;
        return [
            'title' => 'required',
            'number' => [
                'required',
                Rule::unique(Chapter::class)->where('article_id', $articleId),
            ],
            'content' => 'required',
        ];
    }
}
