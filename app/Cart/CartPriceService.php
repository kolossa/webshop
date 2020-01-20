<?php


namespace App\Cart;

use App\Book\BookPriceService;
use App\Discount\DiscountType;

/**
 * This class create the discounts of the all items of a cart
 *
 * Class CartPriceService
 * @package App\Cart
 */
class CartPriceService
{

    /**
     * @var BookPriceService $bookPriceService
     */
    protected $bookPriceService;

    /**
     * CartPriceService constructor.
     * @param BookPriceService $bookPriceService
     */
    public function __construct(BookPriceService $bookPriceService)
    {
        $this->bookPriceService = $bookPriceService;
    }


    public function getSpecialPrice(array $books)
    {
        $publishers = [];
        $publisherDiscounts = [];
        $booksByPublisherId = [];
        $specialPrice = 0;
        foreach ($books as $book) {
            $publishers[$book->publisher->id] = $book->publisher;
            $booksByPublisherId[$book->publisher->id][] = $book;
            $specialPrice += $this->bookPriceService->getSpecialPrice($book);
        }

        foreach ($publishers as $publisher) {
            $discounts = $publisher->discounts;
            
			foreach ($discounts as $discount) {
                
				$discountType = $discount->discountType;
                $rule = $discountType->getDiscountRule();
                if ($discountType->type == DiscountType::TYPE_PACKAGE) {
                    $specialPrice -= $rule->getDiscountPrice($booksByPublisherId[$publisher->id], $discount, $discount->relatedDiscounts);
                } else {
                    foreach ($booksByPublisherId[$publisher->id] as $book) {
                        $specialPrice -= $rule->getDiscountPrice($book, $discount);
                    }
                }
            }
        }

        return $specialPrice;
    }

    public function getCatalogPrice(array $books)
    {

        $catalogPrice = 0;
        foreach ($books as $book) {
            $catalogPrice += $book->price;
        }

        return $catalogPrice;
    }
}
