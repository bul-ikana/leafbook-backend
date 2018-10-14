<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Leaf;

class Book extends Model
{
    protected $fillable = [ 'name' ];
    protected $dates = [ 'deleted_at' ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function leaves () {
        return $this->hasMany(Leaf::class);
    }
}
