<?php

namespace App\Http\Requests\ProjectType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectTypeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'label' => [
                "required",
                "string",
                "max:255",
                Rule::unique('project_types', 'label')->ignore($this->id),
            ],
            'remark' => 'nullable|string|max:1000',
            'active' => "nullable|boolean"
        ];
    }
}
