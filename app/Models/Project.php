<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'owner_id',
        'notes'
    ];



    public function ViewEditProjectPagePath(): string
    {
        return route('ViewEdit.projects' ,['project' => $this->id]);
    }

    public function updateProjectPath(): string
    {
        return route('update.projects' ,['project' => $this->id]);
    }

    public function storeProjectTaskPath(): string
    {
        return route('store.projectTask' ,['project' => $this->id]);
    }

    public function showProjectPath(): string
    {
        return route('show.projects' , ['project' => $this->id]);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class)->latest();
    }

    /**
     * @param $body
     * @return Model
     */
    public function addTask($body): Model
    {
        return $this->tasks()->create(compact('body'));
    }

    public function activity(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    /**
     * @param $description
     * @return void
     */
    public function recordActivity($description): void
    {
        $this->activity()->create(['description' => $description]);

//        Activity::create([
//            'description' => $type,
//            'project_id' => $this->id
//        ]);
    }
}
