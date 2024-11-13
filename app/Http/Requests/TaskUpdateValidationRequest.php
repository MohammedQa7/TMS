<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateValidationRequest extends FormRequest
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
            'title' => 'nullable|string',
            'description' => 'nullable',
            'priority' => 'nullable | string',
            'finishDate' => 'nullable',
            'isCompleted' => ' nullable|boolean',
            'selectedMembers' => 'nullable|array',
            'selectedMembers.*.id' => 'required|exists:users,id'
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated();

        return array_filter($data, function ($value) {
            return $value !== null && $value !== '';
        });
    }
}