<?php

namespace App;

class Borrow extends Model
{
    public $fillable = [
        'user_id',
        'book_id',
        'book_name',
        'borrow_at',
        'expires_at'
    ];


    public static $rules = [
        'user_id' => 'required',
        'book_id' => 'required',
        'book_name' => 'required',
        'borrow' => 'required',
        'expires_at' => 'required'

    ];


    protected $casts = [
        'user_id' => 'integer',
        'book_id' => 'integer',
        'book_name' => 'string',
        'borrow_at' => 'date',
        'expires_at' => 'date'
    ];

	public function book()
	{

		return $this->belongsTo(Book::class);
	
	}





	public function user()
	{

		return $this->belongsTo(User::class);
	
	}

}
