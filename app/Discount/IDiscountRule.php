<?php


namespace App\Discount;


use App\Book\Book;

/**
 * Interface IDiscountRule
 * @package App\Discount
 */
interface IDiscountRule
{
    public function getDiscountPrice(Book $book, Discount $discount);
}
