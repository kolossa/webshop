<?php

namespace App\Discount;

class DiscountTypeFactory
{

    public function create(): DiscountType
    {

        return new DiscountType();
    }
}
