<?php 

namespace App\Author;

interface IAuthorRepository{
	
	public function persist(\App\IEntity $entity);
	public function findByName($name);
}