<?php 

namespace App\Publisher;

class PublisherFactory{
	
	public function create():\App\IEntity{
		
		return new Publisher();
	}
}