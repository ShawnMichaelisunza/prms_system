<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseOrderRequest extends FormRequest
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
            'purchase_request_id' => ['required'],
            'deliver_to' => ['required'],
            'trade' => ['required'],
            'payment_mode' => ['required'],
            'payee' => ['required'],
            'remarks' => ['nullable'],
            'ship_fee' => ['nullable'],
            'other_cost' => ['nullable'],
            'discount' => ['nullable'],
            'total_price' => ['required'],
        ];
    }
}
