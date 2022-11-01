@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-between ">
        <h1>Projects</h1>
        <a href="/projects/create" class="btn btn-primary">New project</a>
    </div>


    <div class="d-flex flex-wrap">
        @forelse($projects as $project)
            <div class="py-4 m-2 rounded-4 shadow-sm border" style="height: 200px; width: 30%; background-color: #fff;">
                @include("projects.card")
            </div>
        @empty
            <div>
                No Projects yet.
            </div>
        @endforelse
    </div>

@endsection

