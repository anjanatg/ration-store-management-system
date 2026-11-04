<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DistributionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id'       => 'required|exists:customers,id',
            'distribution_date' => 'required|date',
            'notes'             => 'nullable|string|max:255',
            'quantities'        => 'required|array',
            'quantities.*'      => 'nullable|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.required'       => 'Please select a customer.',
            'customer_id.exists'         => 'The selected customer is not found.',
            'distribution_date.required' => 'Please select the distribution date.',
            'distribution_date.date'     => 'Enter a valid date.',
            'notes.max'                  => 'Notes must not be more than 255 characters.',
            'quantities.required'        => 'Enter a quantity for at least one product.',
            'quantities.array'           => 'The quantities are not valid.',
            'quantities.*.numeric'       => 'Each quantity must be a number.',
            'quantities.*.min'           => 'A quantity cannot be negative.',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isNotEmpty()) {
                return;
            }
            $total = array_sum($this->quantities);

            if ($total <= 0) {
                $validator->errors()->add('quantities', 'Enter a quantity greater than 0 for at least one product.');
            }
        });
    }
}
