<?php 

namespace App\Publisher;

use App\Publisher\Publisher;

class EloquentPublisherRepository implements IPublisherRepository{
	
	public function persist(\App\IEntity $entity){
		
		$entity->save();
	}
	
	public function count():int{
		
		return Publisher::get()->count();
	}
}