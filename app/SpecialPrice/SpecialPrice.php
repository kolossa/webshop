<?php

namespace App\SpecialPrice;

use Illuminate\Database\Eloquent\Model;

class SpecialPrice extends Model implements \App\IEntity
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'special_prices';
	
	public $incrementing = false;
	
	public function getId(){
		
		return $this->id;
	}
	
	public function books(){
		
		return $this->belongsToMany('App\Book\Book', 'special_prices_books_assign');
	}
	
	public function publishers(){
		
		return $this->belongsToMany('App\Publisher\Publisher', 'special_prices_publishers_assign');
	}
}
