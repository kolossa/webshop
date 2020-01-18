<?php


namespace App\Discount;


class DiscountFactory
{
    public function create(): Discount
    {

        return new Discount();
    }
}
