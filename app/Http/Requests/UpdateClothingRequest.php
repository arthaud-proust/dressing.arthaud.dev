<?php

namespace App\Http\Requests;

use App\Enums\ClothingCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClothingRequest extends FormRequest
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
            'images' => ['array'],
            'images.*' => ['file', 'image', 'max:10000'],
            'description' => ['nullable', 'string', 'max:255'],
            'category' => ['required', Rule::enum(ClothingCategory::class)],
        ];
    }
}
