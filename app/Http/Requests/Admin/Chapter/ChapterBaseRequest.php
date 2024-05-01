<?php

namespace App\Http\Requests\Admin\Chapter;

use App\Http\Requests\BaseRequest;

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
