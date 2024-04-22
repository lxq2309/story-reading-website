<?php

namespace App\Http\Requests\Chapter;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class ChapterBaseRequest extends BaseRequest
{
    public function attributes()
    {
        return [
            'title' => 'Tên chương',
            'number' => 'Thứ tự chương',
            'content' => 'Nội dung',
        ];
    }
}
