<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Book;
use App\Models\Leaf;

class BookTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testBookIsRetrieved () {
        $book = factory(Book::class)->create();

        $response = $this->get(
            'api/books/' . $book->name,
            [ "Accept" => "application/json" ]
        );

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'name' => $book->name
            ]);
    }

    public function testBookIsCreatedIfNotExists () {
        $book = $this->faker->word;

        $response = $this->get(
            'api/books/' . $book,
            [ "Accept" => "application/json" ]
        );

        $this->assertDatabaseHas('books', [
            'name' => $book
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'name' => $book
            ]);
    }

    public function testBookisRetrievedWithLeaves () {
        $book  = factory(Book::class)->create();
        $leaf1 = factory(Leaf::class)->create();
        $leaf2 = factory(Leaf::class)->create();

        $response = $this->get(
            'api/books/' . $book->name,
            [ "Accept" => "application/json" ]
        );

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['id'      =>  $leaf1->id ])
            ->assertJsonFragment(['id'      =>  $leaf2->id ])
            ->assertJsonFragment(['name'    =>  $book->name ])
            ;
    }
}
