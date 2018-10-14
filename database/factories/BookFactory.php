<?php

use Faker\Generator as Faker;

use App\Models\Book;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'name'  =>  $faker->word
    ];
});
