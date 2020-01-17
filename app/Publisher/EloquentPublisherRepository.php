<?php 

namespace App\Publisher;

class EloquentPublisherRepository implements IPublisherRepository{
	
	public function persist(\App\IEntity $entity){
		
		$entity->save();
	}
	
	
	public function findByName($name){
		
		return Publisher::where('name', $name)->first();
	}
}