<?php

namespace App\Services\Project;

class UpdateProjectService
{
    public function run(array $data, object $project): object
    {
        $project->update($data);
        return $project;
    }
}
