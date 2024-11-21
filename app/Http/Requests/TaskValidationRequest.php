<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskValidationRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'nullable',
            'priority' => 'required',
            'finishDate' => 'nullable',
            'projectSlug' => 'required|exists:projects,slug',
            'groupTaskID' => 'required|exists:group_tasks,id',
            'selectedMembers' => 'nullable|array',
            'selectedMembers.*.id' => 'required|exists:users,id',
            'attachments' => 'nullable|array',
            'attachments.*.path' => 'required',
        ];
    }
}