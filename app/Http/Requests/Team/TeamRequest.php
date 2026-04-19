<?php

namespace App\Http\Requests\Team;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\Builder;

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
            'leader_code' => 'required|string|exists:users,code',
            'image' => 'nullable|file|mimes:image/jpeg,image/png|max:2048',
            'description' => 'nullable|string|max:5000'
        ];
    }

    protected function withValidator(Validator $validator): void
    {
        if (!$this->isUpdate()) return;

        $validator->after(function (Validator $validator) {
            $validMember = User::where("code", $this->leader_code ?? null)
                ->whereHas("members", function (Builder $join) {
                    $join->where('team_id', $this->route('id'));
                })
                ->first();

            if (!$validMember) {
                $validator->errors()->add("leader_code", "The selected leader code is not a team member.");
            } else {
                $this->merge([
                    'leader_id' => $validMember->id,
                ]);
            }
        });
    }

    protected function isUpdate(): bool
    {
        return ($this->route()->getName() === "team.update");
    }
}
