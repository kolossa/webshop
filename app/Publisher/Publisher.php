<?php

namespace App\Publisher;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model implements \App\IEntity
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'publishers';
	
	public function getId(){
		
		return $this->id;
	}
	
	public function specialPrices(){
		
		return $this->belongsToMany('App\SpecialPrice\SpecialPrice', 'special_prices_publishers_assign');
	}
}
