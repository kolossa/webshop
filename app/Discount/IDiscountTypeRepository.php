<?php

namespace App\Discount;

use App\Publisher\Publisher;
use App\Book\Book;

interface IDiscountTypeRepository
{

    public function persist(\App\IEntity $entity);

    public function findByPk($id);

    /**
     * @param Discount $discount
     * @return DiscountType
     */
    public function getDiscountTypeByDiscount(Discount $discount);

}
