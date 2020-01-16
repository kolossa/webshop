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
	
	public function getId(){
		
		return $this->id;
	}
}
