<?php


namespace App\Cart;

use App\Book\BookPriceService;
use App\Discount\DiscountType;
use App\Discount\IDiscountRepository;
use App\Discount\IDiscountTypeRepository;
use App\Publisher\IPublisherRepository;

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
     * @var IDiscountRepository $discountRepository
     */
    protected $discountRepository;

    /**
     * @var IPublisherRepository $publisherRepository
     */
    protected $publisherRepository;

    /**
     * @var IDiscountTypeRepository $discountTypeRepository
     */
    protected $discountTypeRepository;

    /**
     * CartPriceService constructor.
     * @param BookPriceService $bookPriceService
     * @param IDiscountRepository $discountRepository
     * @param IPublisherRepository $publisherRepository
     * @param IDiscountTypeRepository $discountTypeRepository
     */
    public function __construct(BookPriceService $bookPriceService, IDiscountRepository $discountRepository, IPublisherRepository $publisherRepository, IDiscountTypeRepository $discountTypeRepository)
    {
        $this->bookPriceService = $bookPriceService;
        $this->discountRepository = $discountRepository;
        $this->publisherRepository = $publisherRepository;
        $this->discountTypeRepository = $discountTypeRepository;
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

            $publisher = $this->publisherRepository->findPublisherByBook($book);
            $publishers[$publisher->id] = $publisher;
            $booksByPublisherId[$publisher->id][] = $book;
            $specialPrice += $this->bookPriceService->getSpecialPrice($book);
        }

        foreach ($publishers as $publisher) {

            $discounts = $this->discountRepository->findAllByPublisher($publisher);


            foreach ($discounts as $discount) {

                $discountType = $this->discountTypeRepository->getDiscountTypeByDiscount($discount);
                $rule = $discountType->getDiscountRule();

                if ($discountType->type == DiscountType::TYPE_PACKAGE) {

                    $relatedDiscounts = $this->discountRepository->getRelatedDiscounts($discount);

                    $relatedDiscountsMap = new \SplObjectStorage();

                    foreach ($relatedDiscounts as $relatedDiscount) {
                        $relatedDiscountsMap[$relatedDiscount] = $this->discountTypeRepository->getDiscountTypeByDiscount($relatedDiscount);
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
