<?php


namespace App\Discount;

/**
 * Discount with fix amount
 *
 * Class DiscountFixAmount
 * @package App\Discount
 */
class DiscountFixAmount implements IDiscount
{
    /**
     * @var double $amount
     */
    private $amount;

    public function __construct($amount)
    {
    }
}
