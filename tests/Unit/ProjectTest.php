<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_project_has_a_path_method()
    {
        $project = Project::factory()->create();

//        dd($project->showProjectPath());
        $this->assertEquals('http://localhost/projects/' . $project->id, $project->showProjectPath());
    }

    public function test_a_project_belongs_to_owner()
    {
        $project = Project::factory()->create();
        $this->assertInstanceOf(User::class, $project->owner);
    }

    public function test_a_project_can_add_a_task()
    {
        $this->withoutExceptionHandling();

        $project = Project::factory()->create();
        $task = $project->addTask('Task Body');

        $this->assertcount(1, $project->tasks);
        $this->assertTrue($project->tasks->contains($task));
    }
}
