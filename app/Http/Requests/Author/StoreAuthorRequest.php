<?php

namespace App\Http\Requests\Author;

use App\Models\Author;
use Illuminate\Validation\Rule;

class StoreAuthorRequest extends AuthorBaseRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                Rule::unique(Author::class),
            ],
        ];
    }
}
