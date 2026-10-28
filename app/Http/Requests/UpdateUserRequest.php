<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->route('id');

        return [
            'name'            => ['required', 'string'],
            'email'           => ['required', 'email', Rule::unique('users', 'email')->ignore($userId)],
            'password'        => ['nullable', 'string', 'min:8', 'confirmed'],
            'age'             => ['nullable', 'integer', 'min:1', 'max:120'],
            'phone'           => ['nullable', 'digits:10'],
            'date_of_birth'   => ['nullable', 'date', 'before:today'],
            'gender'          => ['required'],
            'address'         => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'            => 'Please enter the full name.',
            'email.required'           => 'Please enter an email address.',
            'email.email'              => 'Please enter a valid email address.',
            'email.unique'             => 'This email is already registered.',
            'password.min'             => 'Password must be at least 8 characters.',
            'password.confirmed'       => 'Password and confirm password do not match.',
            'age.integer'              => 'Age must be a whole number.',
            'age.min'                  => 'Age must be at least 1.',
            'age.max'                  => 'Age cannot be more than 120.',
            'phone.digits_between'     => 'Phone number must be 10 to 15 digits, numbers only.',

            'date_of_birth.date'       => 'Please enter a valid date of birth.',
            'date_of_birth.before'     => 'Date of birth must be a date in the past.',

            'gender.required'          => 'Please select a gender.',
            'address.max'              => 'Address cannot be longer than 2000 characters.',

        ];
    }
}