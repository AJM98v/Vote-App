<?php

namespace Tests\Feature;

use App\Http\Livewire\CreateIdea;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateIdeaTest extends TestCase
{
    use RefreshDatabase;


    /**
     * @return void
     * @test
     */

    public function create_idea_form_shows(): void
    {
        $response = $this->get(route('index'));
        $response->assertSuccessful();

        $response->assertSee('Your Idea IS Gold Please Share Us');

    }


    /**
     * @return void
     * @test
     *
     */
    public function livewire_component_create_idea(): void
    {
        $response = $this->get(route('index'))
            ->assertSeeLivewire('create-idea');

    }

    /**
     * @return void
     * @test
     */
    public function create_idea_form_validation_works(): void
    {
        Livewire::test(CreateIdea::class)
            ->set('title', '')
            ->set('category', '')
            ->set('description', '')
            ->call('createIdea')
            ->assertHasErrors(['title', 'category', 'description']);

    }


    /**
     * @return void
     * @test
     */
    public function create_idea_works_correct(): void
    {
        $user = User::factory()->create();

        $category = Category::factory()->create(['name' => 'category One']);

        $status = Status::factory()->create(['name' => 'Open', 'color' => 'black']);


        Livewire::test(CreateIdea::class)
            ->set('title', 'My Idea')
            ->set('category', $category->id)
            ->set('description', 'Hello World')
            ->call('createIdea')
            ->assertRedirect('/');


        $response = $this->get(route('index'));
        $response->assertSuccessful();

        $response->assertSee('My Idea');
        $response->assertSee('Hello World');

        $this->assertDatabaseHas('ideas', ['title' => "My Idea"]);


    }

    /**
     * @return void
     * @test
     */
    public function create_idea_works_correct_with_same_title_with_different_slug(): void
    {
        $user = User::factory()->create();

        $category = Category::factory()->create(['name' => 'category One']);

        $status = Status::factory()->create(['name' => 'Open', 'color' => 'black']);


        Livewire::test(CreateIdea::class)
            ->set('title', 'My Idea')
            ->set('category', $category->id)
            ->set('description', 'Hello World')
            ->call('createIdea')
            ->assertRedirect('/');


        $this->assertDatabaseHas('ideas',
            [
                'title' => "My Idea",
                'slug'=>'my-idea'
            ]);


        Livewire::test(CreateIdea::class)
            ->set('title', 'My Idea')
            ->set('category', $category->id)
            ->set('description', 'Hello World')
            ->call('createIdea')
            ->assertRedirect('/');

        $this->assertDatabaseHas('ideas',
            [
                'title' => "My Idea",
                'slug'=>'my-idea-2'
            ]);


    }


}

