<?php


namespace App\Discount;

/**
 * Percent discounts
 *
 * Class DiscountPercent
 * @package App\Discount
 */
class DiscountPercent implements IDiscount
{
    /**
     * @var double $percent
     */
    protected $percent;

    public function __construct(double $percent)
    {
        $this->percent=$percent;
    }

    /**
     * @param double $price
     * @return double
     */
    public function getSpecialPrice($price){

        return $price*(100-$this->percent);
    }
}
