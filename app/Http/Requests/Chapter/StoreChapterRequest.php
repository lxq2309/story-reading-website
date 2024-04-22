<?php

namespace App\Http\Requests\Chapter;

use App\Models\Chapter;
use Illuminate\Foundation\Http\FormRequest;
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
