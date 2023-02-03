<?php

namespace App\Http\Requests\Property;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            'title' => ['required', 'min:1', 'max:255'],
            'price' => ['required'],
            'currency' => ['required'],
            'description' => ['required', 'min:100'],
            'rooms' => ['required', 'numeric'],
            'types' => ['required'],
            'amenities' => ['array', 'min:1'],
            'amenities.*' => ['sometimes', 'exists:amenities,id'],
            'facilities' => ['array', 'min:1'],
            'facilities.*' => ['sometimes', 'exists:facilities,id'],
            'images' => ['sometimes', 'array'],
            'images.*' => ['image:jpg,jpeg,png'],
            'beds' => ['required', 'numeric'],
            'guests' => ['required', 'numeric'],
            'country' => ['required'],
            'city' => ['required'],
            'address' => ['required', 'min:1', 'max:255'],
            'house_number' => ['required', 'numeric'],
        ];
    }
}
