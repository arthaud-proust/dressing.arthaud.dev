<?php

namespace App\Http\Requests;

use App\Enums\ClothingCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class StoreClothingRequest extends FormRequest
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
            'images.*' => [
                File::image()
                    ->max('10mb'),
            ],
            'description' => ['nullable', 'string', 'max:255'],
            'category' => ['required', Rule::enum(ClothingCategory::class)],
        ];
    }
}
