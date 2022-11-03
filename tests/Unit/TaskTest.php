<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_task_belongs_to_a_project()
    {
        $this->withoutExceptionHandling();

        $task = Task::factory()->create();

        $this->assertInstanceOf(Project::class, $task->project);
    }

    public function test_a_task_can_be_completed()
    {
        $task = Task::factory()->create();

        $this->assertFalse($task->completed);

        $task->complete();

        $this->assertTrue($task->completed);
    }

    public function test_a_task_can_be_marked_as_incomplete()
    {
        $task = Task::factory()->create(['completed' => true]);

        $this->assertTrue($task->completed);

        $task->inComplete();

        $this->assertFalse($task->completed);
    }
}
