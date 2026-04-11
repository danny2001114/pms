<?php

namespace App\Services;

use App\Contracts\Dao\ProjectDaoInterface;
use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\ProjectServiceInterface;
use App\Data\Project\CreateProjectData;
use App\Data\Project\UpdateProjectData;
use App\Http\Requests\Project\ProjectRequest;
use App\Models\Project;

class ProjectService implements ProjectServiceInterface
{
    protected $createProjectData = CreateProjectData::class;
    protected $updateProjectData = UpdateProjectData::class;

    public function __construct(
        protected ProjectDaoInterface $projectDao,
        protected UserDaoInterface $userDao
    )
    {}

    public function getList(): array
    {
        $pending    = $this->projectDao->getPending();
        $processing = $this->projectDao->getProcessing();
        $completed  = $this->projectDao->getCompleted();

        return compact('pending', 'processing', 'completed');;
    }

    public function show(int $id): Project
    {
        return $this->projectDao->show($id);
    }

    public function store(ProjectRequest $request): Project
    {
        $userId = auth('sanctum')->user()->id;
        $data   = $request->validated();
        $data['code']       = $this->generateCode();
        $data['owner_id']   = $userId;
        $data['created_by'] = $userId;

        return $this->projectDao->store(
            $this->createProjectData::from($data)
        );
    }

    public function update(ProjectRequest $request, int $id): void
    {
        $data = $request->validated();

        if ($data['owner_code']) {
            $data['owner_id'] = $this->userDao->getByAttribute('code', $data['owner_code'])->id;
        }

        $this->projectDao->update($id, 
            $this->createProjectData::from($data)
        );
    }

    public function destroy(int $id): void
    {
        $this->projectDao->destroy($id);
    }

    protected function generateCode(): string
    {
        $total = $this->projectDao->countByDate(now());
        return 'P' . now()->format('Ymd') . sprintf("%05d", $total + 1);
    }
}
