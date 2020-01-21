<?php


namespace App\Book;


use App\Discount\IDiscountRepository;
use App\Discount\IDiscountTypeRepository;

class BookPriceService
{

    /**
     * @var IDiscountRepository $discountRepository
     */
    protected $discountRepository;

    /**
     * @var IDiscountTypeRepository $discountTypeRepository
     */
    protected $discountTypeRepository;

    /**
     * BookPriceService constructor.
     * @param IDiscountRepository $discountRepository
     * @param IDiscountTypeRepository $discountTypeRepository
     */
    public function __construct(IDiscountRepository $discountRepository, IDiscountTypeRepository $discountTypeRepository)
    {
        $this->discountRepository = $discountRepository;
        $this->discountTypeRepository = $discountTypeRepository;
    }


    public function getSpecialPrice(Book $book)
    {
        $specialPrice = $book->price;

        $discounts = $this->discountRepository->findAllByBook($book);

        foreach ($discounts as $discount) {

            $discountType = $this->discountTypeRepository->getDiscountTypeByDiscount($discount);
            $rule = $discountType->getDiscountRule();
            $discountPrice = $rule->getDiscountPrice($book, $discount);

            $specialPrice -= $discountPrice;
        }

        return $specialPrice;
    }
}
