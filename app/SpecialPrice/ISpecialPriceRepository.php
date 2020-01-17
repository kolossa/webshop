<?php 

namespace App\SpecialPrice;

use App\Publisher\Publisher;
use App\Book\Book;

interface ISpecialPriceRepository{
	
	public function persist(\App\IEntity $entity);
	public function findByPk($id);
	public function assignBookToSpecialPrice(Book $book, SpecialPrice $specialPrice);
	public function assignPublisherToSpecialPrice(Publisher $publisher, SpecialPrice $specialPrice);
	
}