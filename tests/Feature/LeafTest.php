<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Book;
use App\Models\Leaf;

class LeafTest extends TestCase
{
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
}
