<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MonthlyEntitlementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $entitlement = $this->route('monthlyEntitlement');

        return [
            'card_category_id' => ['required','exists:card_categories,id'],
            'product_id' => ['required','exists:products,id',Rule::unique('monthly_entitlements', 'product_id')->where('card_category_id', $this->card_category_id)->ignore($entitlement?->id)],
            'quantity' => ['required','numeric','gt:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'card_category_id.required' => 'Please select a card category.',
            'card_category_id.exists' => 'The selected card category is invalid.',

            'product_id.required' => 'Please select a product.',
            'product_id.exists' => 'The selected product is invalid.',
            'product_id.unique' => 'This product already exists in the selected card category.',

            'quantity.required' => 'Please enter the quantity.',
            'quantity.numeric' => 'Quantity must be a number.',
            'quantity.gt' => 'Quantity must be greater than 0.',
        ];
    }
}
