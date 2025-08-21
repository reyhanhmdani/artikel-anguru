<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BiographyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'birth_place' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096', // 2MB
            'short_bio' => 'nullable|string',
            'long_bio' => 'nullable|string',
            'achievements' => 'nullable|string',
            'social_media_links' => 'nullable|string',
        ];
    }
}
