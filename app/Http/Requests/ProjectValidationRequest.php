<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectValidationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'nullable',
            'budget' => 'nullable',
            'assignedMembers.*' => 'nullable',
            'startDate' => 'required',
            'endDate' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please provide a name for project',
            'startDate.required' => 'Please provide a start date',
            'endDate.required' => 'Please provide a end date',
        ];
    }
}