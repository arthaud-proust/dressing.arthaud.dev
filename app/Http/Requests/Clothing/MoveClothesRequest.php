<?php

namespace App\Http\Requests\Clothing;

use Illuminate\Foundation\Http\FormRequest;

class MoveClothesRequest extends FormRequest
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
            'clothes_id' => ['array'],
            'clothes_id.*' => [
                'int',
            ],
        ];
    }
}
