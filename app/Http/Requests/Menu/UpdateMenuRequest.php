<?php

namespace App\Http\Requests\Menu;

use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMenuRequest extends MenuBaseRequest
{
    public function rules(): array
    {
        $id = $this->route('menu');
        return [
            'name' => [
                'required',
                Rule::unique(Menu::class)->ignore($id),
            ],
        ];
    }
}
