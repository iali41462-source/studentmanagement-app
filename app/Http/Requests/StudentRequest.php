<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
           'name' => 'required|string|max:255',
           'email' => [
            'required',
            'email',
            Rule::unique('students')->ignore($this->student)
        ],
           'address' => 'required|string|max:255',
           'mobile'  => 'required|digits_between:2,13',
           'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}
