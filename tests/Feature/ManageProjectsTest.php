<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use RefreshDatabase;
    use withFaker;

    public function test_an_authenticated_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

//        $user = User::factory()->create();
//        $this->actingAs($user);
        $this->signIn();


        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $this->post('/projects',$attributes)
        ->assertRedirect('/projects');

        $this->assertDatabaseHas('projects',$attributes);

        $this->get('/projects')
            ->assertSee($attributes['title']);
    }

    public function test_an_authenticated_user_can_view_their_projects()
    {
        $this->signIn();

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    public function test_an_authenticated_user_cant_view_others_projects()
    {
        $this->signIn();

        $project = Project::factory()->create();

        $this->get($project->path())
            ->assertStatus(403);
    }

    public function test_a_project_requires_a_title()
    {
        $this->signIn();

        $attributes = Project::factory()->raw(['title' => '']);

        $this->post('/projects',$attributes)
            ->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description()
    {
        $this->signIn();

        $attributes = Project::factory()->raw(['description' => '']);

        $this->post('/projects',$attributes)
            ->assertSessionHasErrors('description');
    }

    public function test_guests_cant_view_create_page()
    {
        $this->get('/projects/create')
            ->assertRedirect('login');
    }

    public function test_guests_cant_create_projects()
    {
        $attributes = Project::factory()->create();

        $this->post('/projects',$attributes->toArray())
            ->assertRedirect('login');
    }

    public function test_guests_cant_view_projects()
    {
        $this->get('/projects')
            ->assertRedirect('login');
    }

    public function test_guests_cant_view_a_single_project()
    {
        $project = Project::factory()->create();

        $this->get($project->path())
            ->assertRedirect('login');
    }
}
