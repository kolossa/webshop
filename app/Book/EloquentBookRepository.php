<?php 

namespace App\Book;

use App\Book\Book;

class EloquentBookRepository implements IBookRepository{
	
	public function persist(\App\IEntity $entity){
		
		$entity->save();
	}
	
	public function count():int{
		
		return Book::get()->count();
	}
}