<?php 

namespace App\SpecialPrice;

use App\Publisher\Publisher;
use App\Book\Book;

class EloquentSpecialPriceRepository implements ISpecialPriceRepository{
	
	public function persist(\App\IEntity $entity){
		
		$entity->save();
	}
	
	public function findByPk($id){
		
		return SpecialPrice::find($id);
	}
	
	public function assignBookToSpecialPrice(Book $book, SpecialPrice $specialPrice){
		
		$specialPrice->books()->attach($book->id);
	}
	
	public function assignPublisherToSpecialPrice(Publisher $publisher, SpecialPrice $specialPrice){
		
		$specialPrice->publishers()->attach($publisher->id);
	}
}