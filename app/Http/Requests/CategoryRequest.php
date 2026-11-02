<?php

namespace App\Http\Requests;

use App\Models\card_categories;
use App\Models\RationCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        if ($this->routeIs('card-categories.store')) {
            $model = new card_categories();
        } else {
            $model = new RationCategory();
        }

        return [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique($model->getTable(), 'name'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter the category name.',
            'name.unique'   => 'This category already exists.',
            'name.max'      => 'The category name cannot exceed 100 characters.',
        ];
    }
}