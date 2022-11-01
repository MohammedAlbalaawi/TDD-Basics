<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_project_can_have_tasks()
    {
        $this->signIn();
        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $this->post($project->path() . '/tasks', ['body' => 'Task Body']);
        $this->get($project->path())
            ->assertSee('Task Body');
    }

    public function test_only_the_owner_of_the_project_can_add_tasks()
    {
        $this->signIn();
        $project = Project::factory()->create();

        $this->post($project->storePath(), ['body' => 'Task Body'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Task Body']);
    }

    public function test_only_the_owner_of_the_project_can_update_tasks()
    {
        $this->signIn();

        $project = Project::factory()->create();

        $taskModel = $project->addTask('test task');

        $this->put($taskModel->updatePath(), [
            'body' => 'changed',
            'completed' => true
        ])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', [
            'body' => 'changed',
            'completed' => true
        ]);
    }

    public function test_a_task_can_be_updated()
    {

        $this->signIn();

        $project = auth()->user()->projects()->create(Project::factory()->raw());

        $taskModel = $project->addTask('test task');

        $this->put($taskModel->updatePath(), [
            'body' => 'changed',
            'completed' => true
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true
        ]);

    }

    public function test_a_task_requires_a_body()
    {

        $this->signIn();
        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $attributes = Task::factory()->raw(['body' => '']);

        $this->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }

}
