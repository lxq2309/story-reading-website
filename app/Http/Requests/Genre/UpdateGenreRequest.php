<?php

namespace App\Http\Requests\Genre;

use App\Models\Genre;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGenreRequest extends GenreBaseRequest
{
    public function rules(): array
    {
        $id = $this->route('genre');
        return [
            'name' => [
                'required',
                Rule::unique(Genre::class)->ignore($id),
            ]
        ];
    }
}
