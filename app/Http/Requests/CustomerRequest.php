<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
        $customer = $this->route('customer');

        return [
            'card_category_id' => ['required','exists:card_categories,id'],
            'name' => ['required','string','max:255'],
            'address' => ['required','string'],
            'phone' => ['required','digits:10'],
            'ration_card_number' => ['required','string','max:255',Rule::unique('customers', 'ration_card_number')->ignore($customer),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'card_category_id.required' => 'Please select a ration card category.',
            'card_category_id.exists' => 'Selected category is invalid.',
            'name.required' => 'Please enter the customer name.',
            'address.required' => 'Please enter the customer address.',
            'phone.required' => 'Please enter the phone number.',
            'phone.digits' => 'Phone number must contain exactly 10 digits.',
            'ration_card_number.required' => 'Please enter the ration card number.',
            'ration_card_number.unique' => 'This ration card number already exists.',
        ];
    }
}
