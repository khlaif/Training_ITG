<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssignPlayersRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'trainer';
    }

    public function rules(): array
    {
        return [
            'players' => ['required', 'array', 'min:1'],
            'players.*' => [
                'required',
                'integer',
                'distinct',
                Rule::exists('users', 'id')->where('role', 'player'),
            ],
        ];
    }
}
