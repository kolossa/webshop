<?php

namespace App\Discount;

/**
 * Class DiscountTypeFactory
 * @package App\Discount
 */
class DiscountTypeFactory
{

    public function create(): DiscountType
    {

        return new DiscountType();
    }
}
