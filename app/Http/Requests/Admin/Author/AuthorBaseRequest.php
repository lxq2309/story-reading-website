<?php

namespace App\Http\Requests\Admin\Author;

use App\Http\Requests\Admin\BaseRequest;

class AuthorBaseRequest extends BaseRequest
{
    public function attributes(): array
    {
        return [
            'name' => 'Tên tác giả',
        ];
    }
}
