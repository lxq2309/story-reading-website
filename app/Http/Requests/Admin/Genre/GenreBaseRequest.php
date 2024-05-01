<?php

namespace App\Http\Requests\Admin\Genre;

use App\Http\Requests\BaseRequest;

class GenreBaseRequest extends BaseRequest
{
    public function attributes()
    {
        return [
            'name' => 'Tên thể loại',
        ];
    }
}
