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
	
	
}
