<?php 

namespace App\Author;

class AuthorFactory{
	
	public function create():Author{
		
		return new Author();
	}
}