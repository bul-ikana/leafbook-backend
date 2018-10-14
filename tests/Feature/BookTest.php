<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Book;

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
}
