<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Book;

class Leaf extends Model
{
    protected $fillable = [
        'title',
        'content',
        'color',
    ];
    protected $dates = [ 'deleted_at' ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function book () {
        return $this->belongsTo(Book::class);
    }
}
