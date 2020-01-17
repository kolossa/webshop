<?php 

namespace App\Book;

class BookFactory{
	
	public function create():Book{
		
		return new Book();
	}
}