<?php


namespace App\Discount;


use App\Book\Book;
use App\Publisher\Publisher;

class DiscountRulePackage
{

    /**
     * $discount->amount1 in this case is the minimum amount of books of the specific publisher,
     * $discount->amount2 in this case is the number of cheapest book which will be free.
     *
     * @param Publisher $publisher
     * @param Book[] $books
     * @param Discount $discount
     * @param Discount[] $relatedDiscounts
     * @return int
     */
    public function getSpecialPrice(Publisher $publisher, array $books, Discount $discount, array $relatedDiscounts)
    {

        $publisherBooks = [];
        foreach ($books as $book) {

            if ($book->publisher_id == $publisher->id) {
                $publisherBooks[] = $book;
            }
        }

        if (count($publisherBooks) >= $discount->amount1 + $discount->amount2) {

            usort($publisherBooks, function (Book $book1, Book $book2) {
                if ($book1->price == $book2->price) {
                    return 0;
                }
                return ($book1->price < $book2->price) ? -1 : 1;
            });

            $specialPrice = 0;
            for ($i = 1; $i <= $discount->amount2; $i++) {
                $book = array_shift($publisherBooks);

                foreach ($relatedDiscounts as $relatedDiscount) {

                    $discountType = $relatedDiscount->discountType();
                    $rule = $discountType->getDiscountRule();
                    $rule->getSpecialPrice();
                    $specialPrice += $book->price;
                }

            }

            return $specialPrice;
        }


        return 0;
    }
}
