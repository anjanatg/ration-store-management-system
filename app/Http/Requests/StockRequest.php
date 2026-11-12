<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StockRequest extends FormRequest
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
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'numeric', 'gt:0'],
            'transaction_type' => ['required', 'in:addition,deduction'],
            'supplier_name' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'transaction_date' => ['required', 'date'],
        ];
    }
    public function messages(): array
    {
        return [
            'product_id.required' => 'Please select a product.',
            'product_id.exists'   => 'The selected product is invalid.',
            'quantity.required' => 'Please enter the quantity.',
            'quantity.numeric'  => 'Quantity must be a number.',
            'quantity.gt'       => 'Quantity must be greater than 0.',
            'transaction_type.required' => 'Please select the transaction type.',
            'transaction_type.in'       => 'Transaction type must be addition or deduction.',
            'supplier_name.string' => 'Supplier name must be text.',
            'supplier_name.max'    => 'Supplier name cannot be more than 255 characters.',
            'notes.string' => 'Notes must be text.',
            'transaction_date.required' => 'Please select the transaction date.',
            'transaction_date.date'     => 'Please enter a valid transaction date.',
        ];
    }
}
