<?php

namespace App\Http\Requests\Property;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'description' => ['required', 'min:100', 'max:255'],
            'rooms' => ['required', 'numeric'],
            'types' => ['required'],
            'amenities' => ['array'],
            'amenities.*' => ['exists:amenities,id'],
            'facilities' => ['array'],
            'facilities.*' => ['exists:facilities,id'],
            'images' => ['required', 'array'],
            'images.*' => ['image:jpg,jpeg,png'],
            'beds' => ['numeric'],
            'guests' => ['numeric'],
            'country' => ['required', 'min:1', 'max:255'],
            'city' => ['required', 'min:1', 'max:255'],
            'address' => ['required', 'min:1', 'max:255'],
            'house_number' => ['required', 'numeric'],
        ];
    }
}
