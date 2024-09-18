<?php

namespace App\Services\Project;

use App\Models\Project;

class StoreProjectService
{
    private Project $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function run(array $data): object
    {
        return $this->project->create($data);
    }
}
