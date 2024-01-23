<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            'vcard' => 'required|exists:vcards,phone_number|min:9|max:9|regex:/^(9([0-9]{8}))$/',
            'date' => 'required|date',
            'datetime' => 'required|date',
            'type' => 'required|in:C,D',
            'value' => 'required|numeric|min:0.01',
            'old_balance' => 'required|numeric',
            'new_balance' => 'required|numeric',
            'payment_type' => 'required|in:VCARD,MBWAY,PAYPAL,IBAN,MB,VISA',
            'payment_reference' => 'required|min:3|max:50',
            'pair_vcard' => 'required|exists:vcards,phone_number|min:9|max:9|regex:/^(9([0-9]{8}))$/',
            'description' => 'max:50',
            'custom_options' => 'json',
        ];
    }

    /**
     * Custom messages for invalid validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            # Phone
            'value.required' => 'O campo quantidade é obrigatório.',
            'value.min' => 'A quantidade deve ser no mínimo 0.01€.',
            # Description
            'description.max' => 'A descrição deve ter no máximo 50 caracteres.',
        ];
    }
}
