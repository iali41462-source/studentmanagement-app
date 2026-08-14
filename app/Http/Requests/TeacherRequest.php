<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules.
     */
    public function rules(): array
    {
        return [
            'name'    => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'mobile'  => 'required|digits_between:10,15',
        ];
    }

    /**
     * Custom Validation Messages
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Teacher Name is required.',
            'address.required' => 'Address is required.',
            'mobile.required' => 'Mobile Number is required.',
            'mobile.digits_between' => 'Mobile Number must be between 10 and 15 digits.',
        ];
    }

    /**
     * Custom Attribute Names
     */
    public function attributes(): array
    {
        return [
            'name'    => 'Teacher Name',
            'address' => 'Address',
            'mobile'  => 'Mobile Number',
        ];
    }
}
