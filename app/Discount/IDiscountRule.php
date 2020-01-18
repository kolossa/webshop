<?php


namespace App\Discount;


use App\Book\Book;

interface IDiscountRule
{
    public function getDiscountPrice(Book $book, Discount $discount);
}
