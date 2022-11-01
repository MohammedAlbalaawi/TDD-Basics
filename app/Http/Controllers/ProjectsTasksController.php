<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectsTasksController extends Controller
{
    public function update(Project $project,Task $task)
    {
        if (auth()->user()->isNot($task->project->owner)) {
            abort(403);
        }

        $task->update([
            'body' => request('body'),
            'completed' => request()->has('completed'),
        ]);

        return redirect()->to($project->path());
    }

    public function store(Project $project)
    {

        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }

        request()->validate(['body' => 'required']);
        $project->addTask(request('body'));


        return redirect()->to($project->path());
    }
}