<?php 

namespace App\Publisher;

interface IPublisherRepository{
	
	public function persist(\App\IEntity $entity);
	public function findByName($name);
}