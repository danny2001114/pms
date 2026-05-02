<?php

namespace App\Http\Requests\Skill;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SkillRequest extends FormRequest
{
    /**
     * rules for skill validation
     * @return array{active: string[], name: array<string|\Illuminate\Validation\Rules\Unique>}
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('skills', 'name')->ignore($this->id)],
            'active' => ['nullable', 'boolean']
        ];
    }
}
