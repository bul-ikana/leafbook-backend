<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Leaf;
use App\Models\Book;

class LeafController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($name, Request $request) {
        $leaf = new Leaf;
        $leaf->fill($request->all());
        $leaf->book_id = Book::firstOrCreate(['name' => $name])->id;
        if ( $leaf->save() ) {
            return response()->json($leaf, 201);
        } else {
            abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $leaf = Leaf::find($id);

        if ( $leaf ) {
            $leaf->fill($request->all());
            if ( $leaf->save() ) {
                return response()->json($leaf, 200);
            } else {
                abort(500);
            }
        } else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leaf = Leaf::find($id);

        if ( $leaf ) {
            $leaf->delete();
            return response()->json('', 204);
        } else {
            abort(404);
        }
    }
}
