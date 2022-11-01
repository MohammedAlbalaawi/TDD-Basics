@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-between text-decoration-none text-secondary">
        <p><a href="/projects" class="text-decoration-none text-secondary">Project Tasks</a> / {{$project->title}}</p>
        <a href="/projects/create" class="btn btn-primary">New Task</a>
    </div>

    <main>
        <div class="d-flex mt-4">
            <div class="w-75 ">
                <div class="mb-4">
                    <h2>Tasks</h2>

                    @foreach($project->tasks as $task)
                        <div>
                            <form action="{{$project->path() . '/tasks/' . $task->id}}" method="POST">
                                @csrf
                                @method('PATCH')

                                <div class="d-flex form-control p-4 rounded-4 shadow-sm border mb-2" style="background-color: #fff;">
                                    <input name="body" type="text" class="w-100 form-control shadow-sm border p-2 me-1"  value="{{$task->body}}" />
                                    <input name="completed"
                                           type="checkbox"
                                           style="width: 20px;"
                                           onchange="this.form.submit()"
                                           {{ $task->completed ? 'checked' : '' }}
                                    />
                                </div>
                            </form>
                        </div>
                    @endforeach

                    <div class="p-4 rounded-4 shadow-sm border mb-2" style="background-color: #fff;">
                        <form method="POST" action="{{$project->storePath()}}">
                            @csrf
                            <input type="text"
                                   name="body"
                                   placeholder="Add new task.."
                                   class="w-100 form-control shadow-none rounded-3 p-2"/>
                        </form>
                    </div>
                </div>
                <div>
                    <h2>Notes</h2>
                    <div class="p-4 rounded-4 shadow-sm border" style="min-height: 200px; background-color: #fff;">
                        Loerm...
                    </div>

                </div>
            </div>
            <div class="w-25 ms-2" style="margin-top: 43px; height: 250px; background-color: #fff;">
                <div class="py-4 rounded-4 shadow-sm border h-100">
                    @include('projects.card')
                </div>
            </div>
        </div>

    </main>

@endsection
