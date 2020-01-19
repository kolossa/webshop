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
     * @param Book[] $books
     * @param Discount $discount
     * @param Discount[] $relatedDiscounts
     * @return int
     */
    public function getDiscountPrice(array $books, Discount $discount,  $relatedDiscounts)
    {
        $discountPrice = 0;
        $numberOfDiscount = count($books) / $discount->amount1;
        $numberOfDiscount = floor($numberOfDiscount);

        if ($numberOfDiscount > 0) {

            usort($books, function (Book $book1, Book $book2) {
                if ($book1->price == $book2->price) {
                    return 0;
                }
                return ($book1->price > $book2->price) ? -1 : 1;
            });
        }

        while ($numberOfDiscount-- > 0) {

            for ($j = 1; $j <= $discount->amount1; $j++) {

                if (count($books) == 0) {
                    break;
                }

                array_shift($books);
            }
            for ($k = 1; $k <= $discount->amount2; $k++) {

                if (count($books) == 0) {
                    break;
                }

                $book = array_pop($books);

                foreach ($relatedDiscounts as $relatedDiscount) {

                    $discountType = $relatedDiscount->discountType;
                    $rule = $discountType->getDiscountRule();
                    $bookDiscountPrice = $rule->getDiscountPrice($book, $relatedDiscount);
                    $discountPrice+=$bookDiscountPrice;
                }
            }
        }
        return $discountPrice;
    }
}
