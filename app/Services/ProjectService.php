<?php

namespace App\Services;

use App\Contracts\Dao\ProjectDaoInterface;
use App\Contracts\Services\ProjectServiceInterface;
use App\Dto\Project\ProjectCreateDto;
use App\Dto\Project\ProjectUpdateDto;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;

class ProjectService implements ProjectServiceInterface
{
    protected $projectCreateDto = ProjectCreateDto::class;
    protected $projectUpdateDto = ProjectUpdateDto::class;

    public function __construct(
        protected ProjectDaoInterface $projectDao
    )
    {}

    public function getList(): array
    {
        $pending = $this->projectDao->getPending();
        $processing = $this->projectDao->getProcessing();
        $completed = $this->projectDao->getCompleted();

        return compact('pending', 'processing', 'completed');;
    }

    public function getDetail(int $id): Project
    {
        return $this->projectDao->getDetail($id);
    }

    public function store(ProjectRequest $request): void
    {
        $userId = auth('sanctum')->user()->id;
        $data = $request->validated();
        $data['code'] = $this->generateCode();
        $data['owner_id'] = $userId;
        $data['created_by'] = $userId;

        $this->projectDao->store(
            $this->projectCreateDto::pack($data)
        );
    }

    public function update(ProjectRequest $request, int $id): void
    {
        $this->projectDao->update($id, 
            $this->projectUpdateDto::pack($request->validated())
        );
    }

    public function delete(int $id): void
    {
        $this->projectDao->delete($id);
    }

    protected function generateCode(): string
    {
        $total = $this->projectDao->getCountByDate(now());
        return 'P' . now()->format('Ymd') . sprintf("%05d", $total + 1);
    }
}
