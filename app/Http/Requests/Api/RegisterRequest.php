<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email:rfc', 'unique:users,email'],
            'name' => ['required', 'min:1', 'max:30'],
            'phone' => ['required', 'phone:AUTO,US'],
            'surname' => ['required', 'min:1', 'max:30'],
            'password' => ['required', 'min:8', 'max:40', 'confirmed'],
            'agreement' => ['accepted'],
        ];
    }
}
