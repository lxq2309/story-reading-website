<?php

namespace App\Http\Requests\Admin\Menu;

use App\Http\Requests\Admin\BaseRequest;

class MenuBaseRequest extends BaseRequest
{
    public function attributes()
    {
        return [
            'name' => 'Tên link',
        ];
    }
}
