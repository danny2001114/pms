<?php

namespace App\Http\Controllers;

use App\Contracts\Services\SkillServiceInterface;
use App\Http\Requests\Skill\SkillRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

/**
 * handles HTTP requests related to skill operations
 */
class SkillController extends Controller
{
    /**
     * skill contoller constructor
     * @param SkillServiceInterface $skillService inject the skill service
     */
    public function __construct(
        protected SkillServiceInterface $skillService
    ) {}

    /**
     * skill list page
     * @param Request $filter search filter request
     * @return \Inertia\Response
     */
    public function index(Request $filter): Response
    {
        $validatedfilter = $filter->validate([
            "name" => "nullable|string|max:255"
        ]);

        return Inertia::render(page("Skill.Index"), [
            "skills" => $this->skillService->getList($validatedfilter)
        ]);
    }

    /**
     * store skill and redirect to list page
     * @param SkillRequest $request validated skill request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SkillRequest $request): RedirectResponse
    {
        $this->skillService->store($request);
        return redirect()->route('setting.general.skill.index');
    }

    /**
     * update skill and redirect to list page
     * @param int $id skill id
     * @param SkillRequest $request validated skill request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(int $id, SkillRequest $request): RedirectResponse
    {
        $this->skillService->update($id, $request);
        return redirect()->route('setting.general.skill.index');
    }

    /**
     * delete skill
     * @param string $id skill id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->skillService->destroy((int) $id);
        return redirect()->route('setting.general.skill.index');
    }
}
