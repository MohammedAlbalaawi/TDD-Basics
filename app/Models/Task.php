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

    public function updatePath()
    {
        return route('update.projectTask' ,['project' => $this->project_id, 'task' => $this->id]);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
