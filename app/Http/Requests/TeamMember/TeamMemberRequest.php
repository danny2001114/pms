<?php

namespace App\Http\Requests\TeamMember;

use App\Contracts\Services\UserServiceInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class TeamMemberRequest extends FormRequest
{
    /**
     * rules for team member validation
     * @return array{code: array<string|\Illuminate\Validation\Rules\Exists>}
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'string']
        ];
    }

    /**
     * add custom validation after validator
     * @param Validator $validator
     * @return void
     */
    protected function withValidator(Validator $validator): void
    {
        if (!$this->code) return;

        $validator->after(function (Validator $validator) {
            $userService = app(UserServiceInterface::class);
            $extracedCode = $userService->extractCode($this->code);
            $userId = $extracedCode['id'];
            $userRole = $extracedCode['role'];

            if (!$userService->isValidUser($userId, $userRole)) {
                $validator->errors()->add('code', 'Selected user is invalid.');
            }
        });
    }
}
