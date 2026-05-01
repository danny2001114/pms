<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    /**
     * rules for project validation
     * @return array{active: string[], description: string[], end_date: string[], owner_code: string[], priority: array<string|\Illuminate\Validation\Rules\In>, start_date: string[], state: array<string|\Illuminate\Validation\Rules\In>, title: string[], type_id: array<string|\Illuminate\Validation\Rules\Exists>}
     */
    public function rules(): array
    {
        return [
            'owner_code' => ['nullable', 'string'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:5000'],
            'state' => ['nullable', 'integer', Rule::in(config('constants.PROJECT.STATES.ID'))],
            'active' => ['nullable', 'boolean'],
            'type_id' => ['required', 'integer', Rule::exists('project_types', 'id')],
            'priority' => ['nullable', 'integer', Rule::in(config('constants.PROJECT.PRIORITIES.ID'))],
            'start_date' => ['required', 'date', 'date_format:Y-m-d|before:end_date'],
            'end_date' => ['required', 'date', 'date_format:Y-m-d']
        ];
    }
}
