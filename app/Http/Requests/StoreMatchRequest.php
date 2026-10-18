<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMatchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'trainer';
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'match_date' => ['required', 'date'],
            'match_time' => ['required', 'date_format:H:i'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],

            'players' => ['sometimes', 'array'],
            'players.*' => [
                'integer',
                'distinct',
                Rule::exists('users', 'id')
                    ->where('role', 'player'),
            ],
        ];
    }
}
