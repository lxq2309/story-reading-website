<?php

namespace App\Http\Requests\Chapter;

use App\Models\Chapter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateChapterRequest extends ChapterBaseRequest
{
    public function rules(): array
    {
        $id = $this->route('chapter')->id;
        return [
            'title' => 'required',
            'number' => [
                'required',
                Rule::unique(Chapter::class)->ignore($id),
            ],
            'content' => 'required',
        ];
    }
}
