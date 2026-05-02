<?php

namespace App\Contracts\Dao;

use App\Data\Skill\SkillData;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * define the contract for skill access object
 */
interface SkillDaoInterface
{
    /**
     * get skill list
     * @param array $filter
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getList(array $filter): LengthAwarePaginator;
    /**
     * store skill data from data transfer object of skill data
     * @param SkillData $data data transfer object class used for creating skill data
     * @return void
     */
    public function store(SkillData $data): void;
    /**
     * update skill data from data transfer object of skill data
     * @param int $id project type id
     * @param SkillData $data data transfer object class used for updating skill data
     * @return void
     */
    public function update(int $id, SkillData $data): void;
    /**
     * delete skill
     * @param int $id skill id
     * @return void
     */
    public function destroy(int $id): void;
}
