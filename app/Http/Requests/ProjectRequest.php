<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'order' => [
                "required",
                "integer",
                Rule::unique('projects', 'order')->ignore($this->id),
            ],
            'title' => "required|string|max:255",
            'description' => "required|string|max:5000",
            'state' => "nullable|integer|in:" . implode(',', config('constants.PROJECT.STATES.ID')),
            'active' => "nullable|boolean",
            'type_id' => "required|integer|exists:project_types,id",
            'priority' => "nullable|integer|in:" . implode(',', config('constants.PROJECT.PRIORITIES.ID')),
            'start_date' => "required|date|date_format:Y-m-d|before:end_date",
            'end_date' => "required|date|date_format:Y-m-d"
        ];

        // if (request()->route()->getName() == 'project.update') {
        //     $rules['recipient_id'] = "nullable|integer|exists:members,id";
        // }

        return $rules;
    }
}
