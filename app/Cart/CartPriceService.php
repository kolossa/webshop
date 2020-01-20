<?php


namespace App\Cart;

use App\Book\BookPriceService;
use App\Book\IBookRepository;
use App\Discount\DiscountType;
use App\Discount\IDiscountRepository;

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
     * @var IBookRepository $bookRepository
     */
    protected $bookRepository;

    /**
     * @var IDiscountRepository $discountRepository
     */
    protected $discountRepository;

    /**
     * CartPriceService constructor.
     * @param BookPriceService $bookPriceService
     * @param IBookRepository $bookRepository
     * @param IDiscountRepository $discountRepository
     */
    public function __construct(BookPriceService $bookPriceService, IBookRepository $bookRepository, IDiscountRepository $discountRepository)
    {
        $this->bookPriceService = $bookPriceService;
        $this->bookRepository = $bookRepository;
        $this->discountRepository = $discountRepository;
    }


    /**
     * Get the sum of the special prices of books
     *
     * @param array $books
     * @return int|mixed
     */
    public function getSpecialPrice(array $books)
    {
        $publishers = [];
        $booksByPublisherId = [];
        $specialPrice = 0;

        foreach ($books as $book) {

            $publisher = $this->bookRepository->getPublisher($book);
            $publishers[$publisher->id] = $publisher;
            $booksByPublisherId[$publisher->id][] = $book;
            $specialPrice += $this->bookPriceService->getSpecialPrice($book);
        }

        foreach ($publishers as $publisher) {

            $discounts = $this->discountRepository->findAllByPublisher($publisher);


            foreach ($discounts as $discount) {

                $discountType = $this->discountRepository->getDiscountType($discount);
                $rule = $discountType->getDiscountRule();

                if ($discountType->type == DiscountType::TYPE_PACKAGE) {

                    $relatedDiscounts = $this->discountRepository->getRelatedDiscounts($discount);

                    $relatedDiscountsMap=new \SplObjectStorage();

                    foreach ($relatedDiscounts as $relatedDiscount){
                        $relatedDiscountsMap[$relatedDiscount]=$this->discountRepository->getDiscountType($relatedDiscount);
                    }

                    $specialPrice -= $rule->getDiscountPrice($booksByPublisherId[$publisher->id], $discount, $relatedDiscountsMap);
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
