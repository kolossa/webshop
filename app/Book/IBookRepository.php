<?php 

namespace App\Book;

interface IBookRepository{
	
	public function persist(\App\IEntity $entity);
	public function count():int;
}