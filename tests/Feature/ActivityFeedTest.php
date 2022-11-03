<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_a_project_records_activity()
    {
        $project = Project::factory()->create();

        $this->assertCount(1, $project->activity);
        $this->assertEquals('project_created', $project->activity[0]->description);
    }

    public function test_updating_a_project_records_activity()
    {
        $project = Project::factory()->create();

        $project->update(['title' => 'changed']);

        $this->assertCount(2,$project->activity);
        $this->assertEquals('project_updated', $project->activity->last()->description);

    }


    public function test_creating_a_new_task_records_in_project_activity()
    {
        $project = Project::factory()->create();

        $project->addTask('test task');

        $this->assertCount(2,$project->activity);
        $this->assertEquals('task_created', $project->activity->last()->description);

    }

    public function test_completing_a_task_records_in_project_activity()
    {
        $this->signIn();
        $project = Project::factory()->create(['owner_id' => auth()->id()]);
        $task = $project->addTask('test task');

        $this->put($task->updateTaskPath(), [
            'body' => 'any data',
            'completed' => true
        ]);

        $this->assertCount(3,$project->activity);
        $this->assertEquals('task_completed', $project->activity->last()->description);

    }
}
