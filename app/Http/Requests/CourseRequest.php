<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' =>     'required|max:255',
            'syllabus' => 'required',
            'duration' => 'required|integer|min:1|max:60',
        ];

    }
    public function messages(): array
{
    return [
        'name.required' => 'Course Name zaroor enter karein.',
        'duration.max' => 'Duration 60 months se zyada nahi ho sakti.',
        'duration.integer' => 'Duration sirf number honi chahiye.',
    ];
}
}
