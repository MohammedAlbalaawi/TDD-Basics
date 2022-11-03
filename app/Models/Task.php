<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'completed',
        'project_id',
    ];

    protected $touches = ['project'];

    protected $casts = ['completed' => 'boolean'];

    public function updateTaskPath()
    {
        return route('update.projectTask', ['project' => $this->project_id, 'task' => $this->id]);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($task){
            $task->project->recordActivity('task_created');
        });

        static::updated(function ($task){

            if(! $task->completed ) {
                return;
            }

            $task->project->recordActivity('task_completed');
        });
    }

    public function complete()
    {
         $this->update(['completed' => true]);
    }

    public function inComplete()
    {
        $this->update(['completed' => false]);
    }
}
