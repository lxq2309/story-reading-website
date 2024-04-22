<?php

namespace App\Http\Requests\Admin\User;

class StoreBanUserRequest extends UserBaseRequest
{
    public function rules(): array
    {
        return [
            'reason' => 'required',
        ];
    }
}
