<?php

namespace App\Http\Resources\Team;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "leader_id" => $this->leader->id,
            "leader" => $this->leader->name,
            "image" => $this->image,
            "description" => $this->description,
            "members_count" => $this->members_count,
            "members" => $this->members->map(function ($member) {
                return [
                    "id" => $member->id,
                    "user_id" => $member->user->id,
                    "name" => $member->user->name,
                    "code" => $member->user->code
                ];
            }),
        ];
    }
}
