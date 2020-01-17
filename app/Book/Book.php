<?php

namespace App\Book;

use Illuminate\Database\Eloquent\Model;

class Book extends Model implements \App\IEntity
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'books';
	
	public $incrementing = false;
	
	public function getId(){
		
		return $this->id;
	}
	
	public function publisher(){
		
		return $this->belongsTo('App\Publisher\Publisher');
	}
	
	public function authors(){
		
		return $this->belongsToMany('App\Author\Author', 'authors_books_assign');
	}
	
	public function specialPrices(){
		
		return $this->belongsToMany('App\SpecialPrice\SpecialPrice', 'special_prices_books_assign');
	}
}
