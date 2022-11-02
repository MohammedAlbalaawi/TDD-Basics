<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects;
        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
//        if(auth()->id() != $project->owner_id){
//            abort(403);
//        }

//        if (auth()->user()->isNot($project->owner)) {
//            abort(403);
//        }

        $this->authorize('update', $project);

        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $attributes['notes'] = request()->notes;
//        $attributes['owner_id'] = auth()->id();

        $project = auth()->user()->projects()->create($attributes);


        return redirect()->to($project->showProjectPath());
    }

    public function edit(Project $project)
    {
        return view('projects.edit',compact('project'));
    }
    public function update(UpdateProjectRequest $request,Project $project)
    {

//        $this->authorize('update', $project);

//        if (! Gate::allows('update', $project)) {
//            abort(403);
////        }

        $project->update($request->all());

        return redirect()->to($project->showProjectPath());
    }
}
