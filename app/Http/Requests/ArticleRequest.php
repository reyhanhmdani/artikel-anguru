<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
        $rules = [
            'title'      => 'required|string|max:255',
            'content'    => 'required|string',
            'created_at' => 'required|date',
            'category'   => 'nullable|string|max:50',
        ];

        if ($this->isMethod('post')) {
            // Store: image wajib
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:4096';
        } else {
            // Update: image opsional
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096';
        }

        return $rules;
    }
}