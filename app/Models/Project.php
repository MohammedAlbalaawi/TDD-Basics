<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'owner_id',
        'notes'
    ];


    public function ViewEditProjectPagePath()
    {
        return route('ViewEdit.projects' ,['project' => $this->id]);
    }


    public function updateProjectPath()
    {
        return route('update.projects' ,['project' => $this->id]);
    }

    public function storeProjectTaskPath()
    {
        return route('store.projectTask' ,['project' => $this->id]);
    }

    public function showProjectPath()
    {
        return route('show.projects' , ['project' => $this->id]);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class)->latest();
    }

    public function addTask($body)
    {
        return $this->tasks()->create(compact('body'));
    }
}
