<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Book;
use App\Models\Leaf;

class LeafTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testLeafIsCreated () {
        $book = factory(Book::class)->create();
        $leaf = factory(Leaf::class)->raw();

        $response = $this->post(
            'api/books/' . $book->name . '/leaves',
            $leaf,
            [
                "Content-Type" => "application/x-www-form-urlencoded",
                "Accept" => "application/json"
            ]
        );

        $response
            ->assertStatus(201)
            ->assertJsonFragment(['title'   =>  $leaf['title']])
            ->assertJsonFragment(['content' =>  $leaf['content']]);
    }

    public function testLeafIsUpdated () {
        $book = factory(Book::class)->create();
        $leaf = factory(Leaf::class)->create();
        $newTitle = $this->faker->sentence(3);

        $response = $this->put(
            'api/leaves/' . $leaf->id,
            [
                'title' => $newTitle
            ],
            [
                "Content-Type" => "application/x-www-form-urlencoded",
                "Accept" => "application/json"
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['title'   =>  $newTitle])
            ->assertJsonFragment(['content' =>  $leaf->content]);
    }

    public function testLeafIsDeleted () {
        $leaf = factory(Leaf::class)->create();

        $response = $this->delete(
            'api/leaves/' . $leaf->id,
            [ "Accept" => "application/json" ]
        );

        $response
            ->assertStatus(204);

        $this->assertDatabaseHas('leaves', [
            'id'            =>  $leaf->id,
        ]);

        $this->assertDatabaseMissing('leaves', [
            'id'            =>  $leaf->id,
            'deleted_at'    =>  null
        ]);
    }
}
