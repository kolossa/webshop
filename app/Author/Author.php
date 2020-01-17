<?php

namespace App\Author;

use Illuminate\Database\Eloquent\Model;

class Author extends Model implements \App\IEntity
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'authors';
	
	public function getId(){
		
		return $this->id;
	}
}
