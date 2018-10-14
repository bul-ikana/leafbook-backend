<?php

use Faker\Generator as Faker;

use App\Models\Book;
use App\Models\Leaf;

$factory->define(Leaf::class, function (Faker $faker) {
    return [
        'book_id'   =>  function () {
                            if (Book::count()) {
                                return Book::all()->random()->id;
                            } else {
                                return factory(Book::class)->create()->id;
                            }
                        },
        'title'     =>  $faker->optional()->sentence(3),
        'content'   =>  $faker->optional()->realText(512),
        'color'     =>  $faker->optional()->randomDigitNotNull
    ];
});
