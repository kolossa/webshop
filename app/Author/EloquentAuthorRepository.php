<?php 

namespace App\Author;

use App\Author\Author;

class EloquentAuthorRepository implements IAuthorRepository{
	
	public function persist(\App\IEntity $entity){
		
		$entity->save();
	}
	
	
	public function findByName($name){
		
		return Author::where('name', $name)->first();
	}
}