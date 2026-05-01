<?php

namespace App\Http\Requests\ProjectType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectTypeRequest extends FormRequest
{
    /**
     * rules for project type validation
     * @return array{active: string[], label: array<string|\Illuminate\Validation\Rules\Unique>, remark: string[]}
     */
    public function rules(): array
    {
        return [
            'label' => ['required', 'string', 'max:255', Rule::unique('project_types', 'label')->ignore($this->id)],
            'remark' => ['nullable', 'string', 'max:1000'],
            'active' => ['nullable', 'boolean']
        ];
    }
}
