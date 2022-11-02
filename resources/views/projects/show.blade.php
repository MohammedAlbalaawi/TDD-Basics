@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-between text-decoration-none text-secondary">
        <p><a href="/projects" class="text-decoration-none text-secondary">Project Tasks</a> / {{$project->title}}</p>
        <a href="{{route('ViewEdit.projects',$project->id)}}" class="btn btn-primary">Edit Project Info.</a>
    </div>

    <main>
        <div class="d-flex mt-4">
            <div class="w-75 ">
                <div class="mb-4">
                    <h2>Tasks</h2>

                    @foreach($project->tasks as $task)
                        <div>
                            <form action="{{$task->updateTaskPath()}}" method="POST">
                                @csrf
                                @method('put')

                                <div class="d-flex form-control p-4 rounded-4 shadow-sm border mb-2"
                                     style="background-color: #fff;">
                                    <input name="body"
                                           type="text"
                                           class="w-100 form-control shadow-sm border p-2 me-2 {{ $task->completed ? 'text-decoration-line-through' : '' }}"
                                           value="{{$task->body}}"/>
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

                    <div class="p-4 rounded-4  mb-2" style="background-color: #fff;">
                        <form method="POST" action="{{$project->storeProjectTaskPath()}}">
                            @csrf
                            <input type="text"
                                   name="body"
                                   placeholder="Add new task.. ENTER to submit"
                                   class="w-100 form-control shadow-none border rounded-3 p-2"/>
                        </form>
                    </div>
                </div>
                <div>
                    <h2>Notes</h2>
                 <form method="post" action="{{$project->updateProjectPath()}}">
                     @csrf
                     @method('put')

                     <textarea name="notes" class="w-100 form-control border shadow-none p-4 mb-1"
                               style="height: 200px; background-color: #fff; resize: none;"
                               placeholder="Any notes to remember ?">{{$project->notes}}</textarea>
                     <button type="submit" class="btn btn-primary">Save</button>
                 </form>

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
