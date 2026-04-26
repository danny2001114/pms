<?php

namespace App\Http\Requests\Team;

use App\Contracts\Services\UserServiceInterface;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TeamRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'leader_code' => 'required|string',
            'image' => 'nullable|file|mimes:image/jpeg,image/png|max:2048',
            'description' => 'nullable|string|max:5000'
        ];
    }

    /**
     * add custom validation after validator
     * @param Validator $validator
     * @return void
     */
    protected function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $userService = app(UserServiceInterface::class);
            $extracedCode = $userService->extractCode($this->get('leader_code'));
            $user = $userService->show($extracedCode['id']);

            if (empty($user)) {
                $validator->errors()->add("leader_code", "The user code is not a valid code.");
                return;
            } elseif (!($user->role === User::LEADER || $user->role === User::ADMIN)) {
                $validator->errors()->add("leader_code", "The user is not a leader or admin.");
                return;
            }

            if (!$this->isUpdate()) return;

            // TODO : validate in team member service
            $validMember = $user->whereHas("members", function (Builder $join) {
                $join->where('team_id', $this->route('id'));
            })->first();

            if (!$validMember) {
                $validator->errors()->add("leader_code", "The leader code is not a team member.");
            } else {
                $this->merge([
                    'leader_id' => $validMember->id,
                ]);
            }
        });
    }

    /**
     * determine the current route is update or not
     * @return bool
     */
    protected function isUpdate(): bool
    {
        return ($this->route()->getName() === "team.update");
    }
}
