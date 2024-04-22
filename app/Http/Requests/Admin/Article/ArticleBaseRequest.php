<?php

namespace App\Http\Requests\Admin\Article;

use App\Http\Requests\Admin\BaseRequest;

class ArticleBaseRequest extends BaseRequest
{
    public function attributes()
    {
        return [
            'title' => 'Tên truyện',
        ];
    }
}
