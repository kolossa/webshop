<?php 

namespace App\SpecialPrice;

class SpecialPriceFactory{
	
	public function create():SpecialPrice{
		
		return new SpecialPrice();
	}
}