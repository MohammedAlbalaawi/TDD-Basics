<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectsTasksController extends Controller
{
    public function update(Project $project,Task $task)
    {
        $this->authorize('update', $project);
//        if (auth()->user()->isNot($task->project->owner)) {
//            abort(403);
//        }

        $task->update(['body' => request()->body]);

        if (request('completed'))
        {
            $task->complete();

        }else{

            $task->inComplete();
        }

        return redirect()->to($project->showProjectPath());
    }

    public function store(Project $project)
    {

        $this->authorize('update', $project);
//        if (auth()->user()->isNot($project->owner)) {
//            abort(403);
//        }

        request()->validate(['body' => 'required']);
        $project->addTask(request('body'));


        return redirect()->to($project->showProjectPath());
    }
}
