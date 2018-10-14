<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;

class BookController extends Controller
{
    public function getBook ( $name ) {
        $book = Book::firstOrCreate(['name' => $name]);
        return response()->json($book, 200);
    }
}
