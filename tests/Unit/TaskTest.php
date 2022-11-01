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
}
