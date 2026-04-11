<?php

namespace App\Http\Requests\Task;

use App\Contracts\Services\ProjectServiceInterface;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(ProjectServiceInterface $projectService): array
    {
        $dateRanges = $this->getProjectDateRange($projectService);
        return [
            'description' => 'required|string|max:5000',
            'priority'    =>  "nullable|integer|in:" . implode(',', config('constants.PROJECT.STATES.ID')),
            'state'       =>  "nullable|integer|in:" . implode(',', config('constants.PROJECT.STATES.ID')),
            'start_date'  => "required|date|date_format:Y-m-d|before:end_date|after_or_equal:{$dateRanges->start_date}",
            'end_date'    => "required|date|date_format:Y-m-d|before_or_equal:{$dateRanges->end_date}"
        ];
    }

    protected function getProjectDateRange(ProjectServiceInterface $projectService)
    {
        $project = $projectService->show($this->project_id);
        return (object) [
            "start_date" => $project->start_date ?? "",
            "end_date"   => $project->end_date ?? ""
        ];
    }
}
