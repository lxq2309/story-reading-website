<?php

namespace App\Http\Requests\Admin\User;

use App\Http\Requests\Admin\BaseRequest;

class UserBaseRequest extends BaseRequest
{
    public function attributes()
    {
        return [
            'reason' => 'Lý do ban',
        ];
    }
}
