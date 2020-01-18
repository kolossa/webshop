<?php


namespace App\Book;


class BookPriceService
{
    public function getSpecialPrice(Book $book)
    {
        $specialPrice = $book->price;

        foreach ($book->discounts as $discount) {

            $discountType = $discount->discountType;
            $rule = $discountType->getDiscountRule();
            $discountPrice = $rule->getDiscountPrice($book, $discount);

            $specialPrice -= $discountPrice;
        }

        return $specialPrice;
    }
}
