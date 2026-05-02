<?php

namespace App\Contracts\Services;

use App\Http\Requests\Skill\SkillRequest;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * defines the contract for skill related business logic
 */
interface SkillServiceInterface
{
    /**
     *  get skill list
     * @param ?array $filter validated search request
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getList(?array $filter = []): LengthAwarePaginator;
    /**
     * store skill with validated data
     * @param SkillRequest $request validated skill data
     * @return void
     */
    public function store(SkillRequest $request): void;
    /**
     * update skill with validated data
     * @param int $id skill id
     * @param SkillRequest $request validated skill data
     * @return void
     */
    public function update(int $id, SkillRequest $request): void;
    /**
     * delete skill
     * @param int $id skill id
     * @return void
     */
    public function destroy(int $id): void;
}
