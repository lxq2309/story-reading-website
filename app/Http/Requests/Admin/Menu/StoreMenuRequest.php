<?php

namespace App\Http\Requests\Admin\Menu;

use App\Models\Menu;
use Illuminate\Validation\Rule;

class StoreMenuRequest extends MenuBaseRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                Rule::unique(Menu::class),
            ],
        ];
    }
}
