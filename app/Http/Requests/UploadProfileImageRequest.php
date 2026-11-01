<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadProfileImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'player';
    }

    public function rules(): array
    {
        return [
            'profile_image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'profile_image.required' => 'Please select a profile image.',
            'profile_image.image' => 'The uploaded file must be an image.',
            'profile_image.mimes' => 'Only JPG, JPEG, and PNG images are allowed.',
            'profile_image.max' => 'The image must not exceed 2 MB.',
        ];
    }
}
