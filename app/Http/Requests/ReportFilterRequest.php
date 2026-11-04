<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'start_date' => ['nullable','date','before_or_equal:end_date'],
            'end_date' => [ 'nullable', 'date', 'after_or_equal:start_date'],
            'customer_id' => ['nullable','integer','exists:customers,id'],
            'product_id' => ['nullable','integer','exists:products,id'],
            'card_category_id' => ['nullable','integer','exists:card_categories,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'start_date.date' => 'Please enter a valid start date.',
            'start_date.before_or_equal' => 'Start date must be before or equal to end date.',

            'end_date.date' => 'Please enter a valid end date.',
            'end_date.after_or_equal' => 'End date must be after or equal to start date.',

            'customer_id.exists' => 'Selected customer does not exist.',
            'product_id.exists' => 'Selected product does not exist.',
            'card_category_id.exists' => 'Selected ration card category does not exist.',
        ];
    }
}