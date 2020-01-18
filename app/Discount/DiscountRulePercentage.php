<?php


namespace App\Discount;

use App\Book\Book;

/**
 * Percent discounts
 *
 * Class DiscountPercent
 * @package App\Discount
 */
class DiscountRulePercentage implements IDiscountRule
{
    /**
     * @param Book $book
     * @param Discount $discount
     * @return float|int
     */
    public function getDiscountPrice(Book $book, Discount $discount)
    {

        return $book->price * $discount->amount1;
    }
}
