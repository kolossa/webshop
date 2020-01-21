<?php


namespace App\Discount;

/**
 * Class DiscountFactory
 * @package App\Discount
 */
class DiscountFactory
{
    public function create(): Discount
    {

        return new Discount();
    }
}
