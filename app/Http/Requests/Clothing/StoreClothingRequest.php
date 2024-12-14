<?php

namespace App\Http\Requests\Clothing;

use App\Models\ClothesCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class StoreClothingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
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
            'clothes_category_id' => ['required', Rule::exists(ClothesCategory::class, 'id')->where('user_id', $this->user()->id)],
        ];
    }
}
