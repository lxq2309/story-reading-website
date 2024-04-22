<?php

namespace App\Http\Requests\Admin\Chapter;

use App\Models\Chapter;
use Illuminate\Validation\Rule;

class StoreChapterRequest extends ChapterBaseRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required',
            'number' => [
                'required',
                Rule::unique(Chapter::class),
            ],
            'content' => 'required',
        ];
    }
}
