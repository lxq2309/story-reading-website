<?php

namespace App\Http\Requests\Admin\Author;

use App\Models\Author;
use Illuminate\Validation\Rule;

class UpdateAuthorRequest extends AuthorBaseRequest
{
    public function rules(): array
    {
        $id = $this->route('author');
        return [
            'name' => [
                'required',
                Rule::unique(Author::class)->ignore($id),
            ],
        ];
    }
}
