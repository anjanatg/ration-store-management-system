<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $productId = $this->route('id');

        return [
            'category_id' => ['required','exists:ration_categories,id'],
            'name' => ['required','string','max:255',Rule::unique('products', 'name')->where('category_id', $this->input('category_id'))->ignore($productId)],
            'unit' => ['required',Rule::in(['kg', 'litre', 'packet'])],
            'price' => ['required','numeric','min:0'],
            'available_stock' => ['required','numeric','min:0',],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'The selected category is invalid.',
            'name.required' => 'Please enter the product name.',
            'name.unique' => 'This product already exists in the selected category.',
            'unit.required' => 'Please select a unit.',
            'unit.in' => 'The selected unit is invalid.',
            'price.required' => 'Please enter the product price.',
            'price.min' => 'The price cannot be negative.',
            'available_stock.required' => 'Please enter the available stock.',
            'available_stock.min' => 'The available stock cannot be negative.',
        ];
    }
}
