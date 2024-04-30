<?php

namespace App\Http\Requests\Admin\Chapter;

use App\Models\Chapter;
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
                Rule::unique(Chapter::class)->ignore($id)
                    ->where('article_id', $this->route('article')->id),
            ],
            'content' => 'required',
        ];
    }
}
