<?php

namespace App\Http\Requests\Menu;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class MenuBaseRequest extends BaseRequest
{
    public function attributes()
    {
        return [
            'name' => 'Tên link',
        ];
    }
}
