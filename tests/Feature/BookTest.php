<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use WithFaker, RefreshDatabase;

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
