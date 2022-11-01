<a href="{{$project->path()}}" style="text-decoration: none;">
    <h3 class="border-start border-4 border-info ps-3 h-25 d-flex align-items-center">{{$project->title}}</h3>
</a>

<div style="color: #6c757d;" class="ps-4 pe-2">{{\Illuminate\Support\Str::limit($project->description,200)}}</div>


