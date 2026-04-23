<?php

namespace App\Http\Requests\User;

use App\Contracts\Services\UserServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

/**
 * handles validations and authorizations for creating or updating user.
 */
class UserRequest extends FormRequest
{
    /**
     * rules for user validation
     * @return array{email: array<string|\Illuminate\Validation\Rules\Unique>, gender: array<string|\Illuminate\Validation\Rules\In>, name: string[], phone: array<string|\Illuminate\Validation\Rules\Unique>, role: array<string|\Illuminate\Validation\Rules\In>}
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:100'],
            'role' => ['nullable', 'integer',  Rule::in(config('constants.USER.ROLES.ID'))],
            'gender' => ['required', 'integer', Rule::in(config('constants.USER.GENDERS.ID'))],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->id)->whereNull('deleted_at')],
            'phone' => ['required', 'regex:/^09\d{6,9}$/', Rule::unique('users')->ignore($this->id)->whereNull('deleted_at')],
        ];

        if (!$this->isUpdate()) {
            $rules['password'] = ['required', 'string', 'min:6','max:20'];
        }

        if ($this->isUpdate()) {
            $rules = array_merge($rules, [
                'address' => ['nullable', 'string', 'max:1000'],
                'birthday' => ['nullable', 'date', 'before:-18 years'],
                'bio' => ['nullable', 'string', 'max:5000'],
                'image' => ['nullable', 'string', 'max:100'],
            ]);
        }

        return $rules;
    }

    /**
     * determine the route is update or not
     * @return bool
     */
    protected function isUpdate(): bool
    {
        return $this->route()->getName() === 'user.update';
    }
    
    /**
     * add custom validation after validator
     * @param Validator $validator
     * @return void
     */
    protected function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            if (!$this->isUpdate()) return;
            $userService = app(UserServiceInterface::class);

            if ($userService->isSuperAdmin($this->id)) {
                $validator->errors()->add('failed', "Super Admin can't be update.");
            }
        });
    }
}
