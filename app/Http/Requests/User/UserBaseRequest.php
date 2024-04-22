<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserBaseRequest extends BaseRequest
{
    public function attributes()
    {
        return [
            'reason' => 'Lý do ban',
        ];
    }
}
