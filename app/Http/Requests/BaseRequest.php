<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống!',
            'unique' => ':attribute đã tồn tại!',
        ];
    }
}
