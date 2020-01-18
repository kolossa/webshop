<?php

namespace App\Discount;

use App\Publisher\Publisher;
use App\Book\Book;

interface IDiscountTypeRepository{

	public function persist(\App\IEntity $entity);
	public function findByPk($id);

}
