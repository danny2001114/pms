<?php

namespace App\Contracts\Services;

/**
 * defines the contract for team member related business logic
 */
interface TeamMemberServiceInterface
{
    /**
     * store member with validated data
     * @param int $teamId
     * @param string $code
     * @return void
     */
    public function store(int $teamId, string $code): void;
    /**
     * delete user
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;
}
