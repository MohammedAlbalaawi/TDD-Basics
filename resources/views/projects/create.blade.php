@extends('layouts.app')

@section('content')

<form method="post" action="/projects" class="container w-50">
    @csrf
    <h3>Create New Project</h3>
    <div class="form-group mb-1">
        <input type="text" class="form-control border shadow-none my-2" style="background-color: #fff;" name="title" placeholder="Enter title">
{{--        <small id="emailHelp" class="form-text text-muted">make sure your name describes your project</small>--}}
    </div>
    <div class="form-group mb-1">
        <textarea class="form-control border shadow-none my-2"  style="min-height: 200px;background-color: #fff;" name="description" rows="3" placeholder="Enter description"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="/projects" class="btn btn-danger">Cancel</a>
</form>
@endsection
