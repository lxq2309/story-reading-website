<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegsiterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => [
                'required', 'string', 'max:20', 'unique:'.User::class
            ],
            'name' => ['string', 'max:100'],
            'email' => [
                'required', 'string', 'lowercase', 'email', 'max:100',
                'unique:'.User::class
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function messages()
    {
        return [
            'unique' => ':attribute đã tồn tại trong hệ thống.',
        ];
    }

    public function attributes()
    {
        return [
            'username' => 'Tên đăng nhập'
        ];
    }
}
