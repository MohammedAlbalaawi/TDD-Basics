<?php

namespace Tests\Setup;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;

class ProjectFactory
{
    protected $tasksCount = 0;

    public function create()
    {
        $project = Project::factory()->create([
            'owner_id' => User::factory()->create()
        ]);

        Task::factory($this->tasksCount)->create([
            'project_id' => $project->id
        ]);

        return $project;
    }

    public function withTasks($count)
    {
        $this->tasksCount = $count;
        return $this;
    }
}
