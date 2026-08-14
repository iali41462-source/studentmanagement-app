<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'enrollment_id' => 'required|exists:enrollments,id',
            'paid_date'     => 'required|date',
            'amount'        => 'required|numeric|min:1',
        ];
    }

    /**
     * Custom Validation Messages
     */
    public function messages(): array
    {
        return [
            'enrollment_id.required' => 'Please select an Enrollment.',
            'enrollment_id.exists'   => 'Selected Enrollment is invalid.',

            'paid_date.required' => 'Paid Date is required.',
            'paid_date.date'     => 'Please enter a valid date.',

            'amount.required' => 'Amount is required.',
            'amount.numeric'  => 'Amount must be a number.',
            'amount.min'      => 'Amount must be greater than 0.',
        ];
    }

    /**
     * Custom Attribute Names
     */
    public function attributes(): array
    {
        return [
            'enrollment_id' => 'Enrollment',
            'paid_date'     => 'Paid Date',
            'amount'        => 'Amount',
        ];
    }
}
