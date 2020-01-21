<?php


namespace App\Discount;


use App\Book\Book;

class DiscountRulePackage
{

    /**
     * $discount->amount1 in this case is the minimum amount of books of the specific publisher,
     * $discount->amount2 in this case is the number of cheapest book which will be free.
     *
     * @param Book[] $books - books must be same publisher!
     * @param Discount $discount
     * @param $relatedDiscountsMap
     * @return int
     */
    public function getDiscountPrice(array $books, Discount $discount, \SplObjectStorage $relatedDiscountsMap)
    {
        if(count($books)==0){
            return 0;
        }

        $publisherCheck=[];
        foreach ($books as $book){
            $publisherCheck[$book->publisher_id]=$book->publisher_id;
        }

        if(count($publisherCheck)>1){
            throw new \BadMethodCallException('Books must be assigned with the same publisher!');
        }
		
		if($relatedDiscountsMap->count()==0){
			throw new \BadMethodCallException('There are not any discount rule!');
		}

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

                foreach ($relatedDiscountsMap as $relatedDiscount) {

                    $discountType=$relatedDiscountsMap[$relatedDiscount];
                    $rule = $discountType->getDiscountRule();
                    $bookDiscountPrice = $rule->getDiscountPrice($book, $relatedDiscount);
                    $discountPrice += $bookDiscountPrice;
                }
            }
        }
        return $discountPrice;
    }
}
