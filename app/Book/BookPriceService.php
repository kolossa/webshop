<?php


namespace App\Book;


use App\Discount\IDiscountRepository;

class BookPriceService
{

    /**
     * @var IDiscountRepository $discountRepository
     */
    protected $discountRepository;

    /**
     * BookPriceService constructor.
     * @param IDiscountRepository $discountRepository
     */
    public function __construct(IDiscountRepository $discountRepository)
    {
        $this->discountRepository = $discountRepository;
    }


    public function getSpecialPrice(Book $book)
    {
        $specialPrice = $book->price;

        $discounts = $this->discountRepository->findAllByBook($book);

        foreach ($discounts as $discount) {

            $discountType = $this->discountRepository->getDiscountType($discount);
            $rule = $discountType->getDiscountRule();
            $discountPrice = $rule->getDiscountPrice($book, $discount);

            $specialPrice -= $discountPrice;
        }

        return $specialPrice;
    }
}
