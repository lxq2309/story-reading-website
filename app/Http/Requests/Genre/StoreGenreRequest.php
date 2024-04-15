<?php

namespace App\Http\Requests\Genre;

use App\Models\Genre;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGenreRequest extends GenreBaseRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                Rule::unique(Genre::class),
            ],
        ];
    }
}
