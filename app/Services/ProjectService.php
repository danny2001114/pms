<?php

namespace App\Services;

use App\Contracts\Dao\ProjectDaoInterface;
use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\ProjectServiceInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Data\Project\CreateProjectData;
use App\Data\Project\UpdateProjectData;
use App\Http\Requests\Project\ProjectRequest;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

/**
 * handles business logic related to user operations
 */
class ProjectService implements ProjectServiceInterface
{
    /**
     * data transfer object class used for creating project data.
     * @var 
     */
    protected string $createProjectData = CreateProjectData::class;

    /**
     * data transfer object class used for updating project data.
     * @var string
     */
    protected string $updateProjectData = UpdateProjectData::class;

    /**
     * project service constructor
     * @param ProjectDaoInterface $projectDao inject the project data access object
     * @param UserDaoInterface $userDao inject the user data access object
     * @param UserServiceInterface $userService inject the user service
     */
    public function __construct(
        protected ProjectDaoInterface $projectDao,
        protected UserDaoInterface $userDao,
        protected UserServiceInterface $userService
    ) {}

    /**
     * @inheritDoc
     */
    public function getList(): array
    {
        $pending = $this->projectDao->getPending();
        $processing = $this->projectDao->getProcessing();
        $completed = $this->projectDao->getCompleted();

        return compact('pending', 'processing', 'completed');;
    }

    /**
     * @inheritDoc
     */
    public function getDetail(int $id): Project
    {
        return $this->projectDao->getDetail($id);
    }

    /**
     * @inheritDoc
     */
    public function store(ProjectRequest $request): Project
    {
        $userId = auth('sanctum')->user()->id;
        $data = $request->validated();
        $data['code'] = $this->generateCode();
        $data['owner_id'] = $userId;
        $data['created_by'] = $userId;

        return DB::transaction(function () use ($data) {
            return $this->projectDao->store($this->createProjectData::from($data));
        });
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, ProjectRequest $request): void
    {
        $data = $request->validated();
        
        if ($data['owner_code']) {
            $user = $this->userService->extractCode($data['owner_code']);
            $data['owner_id'] = $user['id'];
        }

        DB::transaction(function () use ($id, $data) {
            $this->projectDao->update($id, $this->updateProjectData::from($data));
        });
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): void
    {
        DB::transaction(function () use ($id) {
            $this->projectDao->delete($id);
        });
    }

    /**
     * generate the project code by current date and total projects of current data plus one
     * @return string
     */
    protected function generateCode(): string
    {
        $total = $this->projectDao->countByDate(now());
        return 'P' . now()->format('Ymd') . sprintf("%05d", $total + 1);
    }
}
