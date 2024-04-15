<?php

namespace App\Http\Requests\Author;

use App\Http\Requests\BaseRequest;
use App\Models\Author;

class AuthorBaseRequest extends BaseRequest
{
    public function attributes(): array
    {
        return [
            'name' => 'Tên tác giả',
        ];
    }
}
