<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
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
            'user_id' => ['required'],
            'supplier_id' => ['required'],
            'item_name' => ['required'],
            'item_uom' => ['required'],
            'item_image' => ['nullable', 'mimes:png,jpg,jpeg', 'max:2048'],
            'price' => ['required'],
        ];
    }
}
