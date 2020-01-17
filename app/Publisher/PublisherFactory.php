<?php 

namespace App\Publisher;

class PublisherFactory{
	
	public function create():Publisher{
		
		return new Publisher();
	}
}