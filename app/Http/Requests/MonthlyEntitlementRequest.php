<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MonthlyEntitlementRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        return [
            'card_category_id' => ['required','exists:card_categories,id'],
            'product_id' => ['required','exists:products,id',Rule::unique('monthly_entitlements')->where('card_category_id', $this->card_category_id)->ignore($this->route('monthly_entitlement'))],
            'quantity' => ['required','numeric','gt:0'],
        ];
    }
}
