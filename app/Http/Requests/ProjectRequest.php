<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'order' => "required|interger|unique",
            'title' => "required|string|max:255",
            'description' => "required|string",
            'state' => "nullable|integer|in:" . implode(',', config('constants.PROJECT_STATES.ID')),
            'active' => "nullable|boolean",
            'type' => "required|integer|exists:project_types,id",
            'is_client' => "nullable|boolean",
            'start_date' => "required|date|date_format:Y-m-d|before:end_date",
            'end_date' => "required|date|date_format:Y-m-d|after:start_date"
        ];
    }
}
