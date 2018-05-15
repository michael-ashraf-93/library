<?php

namespace App;

use Carbon\Carbon;

class Book extends Model
{

    public $fillable = [
        'serial',
        'book_name',
        'category',
        'author_name',
        'publication_date',
        'status'
    ];


    public static $rules = [
        'serial' => 'required',
        'book_name' => 'required',
        'category' => 'required',
        'author_name' => 'required',
        'publication_date' => 'required',
        'status' => 'required'
    ];


    protected $casts = [
        'serial' => 'string',
        'book_name' => 'string',
        'category' => 'string',
        'author_name' => 'string',
        'publication_date' => 'date',
        'status' => 'string'
    ];


    public function borrows()
    {

        return $this->hasMany(Borrow::class);

    }


}
