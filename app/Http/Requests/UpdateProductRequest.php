<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if ($method === 'PUT') {
            return [
                'name' => ['required', 'string', 'max:20', 'min:1'],
                'description' => ['required', 'string', 'max:255', 'min:0'],
                'price' => ['required', 'numeric', 'min:0'],
                'stock' => ['required', 'integer', 'min:0'],
            ];
        } else {
            return [
                'name' => ['sometimes', 'required', 'string', 'max:20', 'min:1'],
                'description' => ['sometimes', 'required', 'string', 'max:255', 'min:0'],
                'price' => ['sometimes', 'required', 'numeric', 'min:0'],
                'stock' => ['sometimes', 'required', 'integer', 'min:0'],
            ];
        }
    }
}
