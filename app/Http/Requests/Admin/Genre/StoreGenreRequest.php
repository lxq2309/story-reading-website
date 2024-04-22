<?php

namespace App\Http\Requests\Admin\Genre;

use App\Models\Genre;
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
