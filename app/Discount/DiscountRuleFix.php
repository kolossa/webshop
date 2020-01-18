<?php


namespace App\Discount;

use App\Book\Book;

/**
 * Discount with fix amount
 *
 * Class DiscountFixAmount
 * @package App\Discount
 */
class DiscountRuleFix implements IDiscountRule
{
    /**
     * @param Book $book
     * @param Discount $discount
     * @return mixed
     */
    public function getDiscountPrice(Book $book, Discount $discount)
    {

        return $discount->amount1;
    }
}
