<?php

namespace App\Http\Requests\Author;

use App\Models\Author;
use Illuminate\Foundation\Http\FormRequest;
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
