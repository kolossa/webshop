<?php

namespace App\Console\Commands;

use App\Discount\DiscountFactory;
use App\Discount\IDiscountRepository;
use Illuminate\Console\Command;
use \App\Discount\IDiscountTypeRepository;
use \App\Discount\DiscountTypeFactory;
use \App\Book\IBookRepository;
use \App\Publisher\IPublisherRepository;

/**
 * Upload discount data from the pdf.
 *
 * Class UploadSpecialPrices
 * @package App\Console\Commands
 */
class UploadDiscounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discounts:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload basic discount test data';

    /**
     * @var IDiscountTypeRepository $discountTypeRepository
     */
    protected $discountTypeRepository;

    /**
     * @var DiscountTypeFactory $discountTypeFactory
     */
    protected $discountTypeFactory;

    /**
     * @var IBookRepository $bookRepository
     */
    protected $bookRepository;

    /**
     * @var IPublisherRepository $publisherRepository
     */
    protected $publisherRepository;

    /**
     * @var DiscountFactory $discountFactory
     */
    protected $discountFactory;

    /**
     * @var IDiscountRepository $discountRepository
     */
    protected $discountRepository;

    /**
     * UploadDiscounts constructor.
     * @param IDiscountTypeRepository $discountTypeRepository
     * @param DiscountTypeFactory $discountTypeFactory
     * @param DiscountFactory $discountFactory
     * @param IDiscountRepository $discountRepository
     * @param IBookRepository $bookRepository
     * @param IPublisherRepository $publisherRepository
     */
    public function __construct(IDiscountTypeRepository $discountTypeRepository, DiscountTypeFactory $discountTypeFactory, DiscountFactory $discountFactory, IDiscountRepository $discountRepository, IBookRepository $bookRepository, IPublisherRepository $publisherRepository)
    {
        parent::__construct();


        $this->discountTypeRepository = $discountTypeRepository;
        $this->discountTypeFactory = $discountTypeFactory;
        $this->bookRepository = $bookRepository;
        $this->publisherRepository = $publisherRepository;
        $this->discountFactory = $discountFactory;
        $this->discountRepository = $discountRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->uploadDiscountsWithBooksAndPublishersAssign();
    }


    private function uploadDiscountsWithBooksAndPublishersAssign()
    {

        $counter = 0;

        $discounts = $this->getDiscounts();

        foreach ($discounts as $discountAttributes) {

            $discountType = $this->discountTypeRepository->findByPk($discountAttributes['id']);

            if ($discountType != null) {
                continue;
            }

            $discountType = $this->discountTypeFactory->create();
            $discountType->id = $discountAttributes['id'];
            $discountType->type = $discountAttributes['type'];
            $discountType->description = $discountAttributes['description'];
            $this->discountTypeRepository->persist($discountType);

            $discount = $this->discountFactory->create();
            $discount->discount_type_id = $discountType->id;
            $i = 1;
            if (isset($discountAttributes['amounts'])) {
                foreach ($discountAttributes['amounts'] as $amount) {
                    $amountAttribute = 'amount' . $i++;
                    $discount->$amountAttribute = $amount;
                }
            }
            $this->discountRepository->persist($discount);

            if (isset($discountAttributes['books'])) {

                foreach ($discountAttributes['books'] as $bookId) {

                    $book = $this->bookRepository->findByPk($bookId);

                    if ($book) {

                        $this->discountRepository->assignBook($discount, $book);
                    }
                }
            } elseif (isset($discountAttributes['publishers'])) {

                foreach ($discountAttributes['publishers'] as $name) {

                    $publisher = $this->publisherRepository->findByName($name);

                    if ($publisher) {

                        $this->discountRepository->assignPublisher($discount, $publisher);
                    }
                }
            }

            if (isset($discountAttributes['relations'])) {

                foreach ($discountAttributes['relations'] as $relationData) {

                    $relatedDiscount = $this->discountFactory->create();
                    $relatedDiscount->discount_type_id = $relationData['discount_type_id'];
                    $i = 1;
                    if (isset($relationData['amounts'])) {
                        foreach ($relationData['amounts'] as $amount) {
                            $amountAttribute = 'amount' . $i++;
                            $relatedDiscount->$amountAttribute = $amount;
                        }
                    }
                    $this->discountRepository->persist($relatedDiscount);
                    $this->discountRepository->assignRelatedDiscount($discount, $relatedDiscount);

                }
            }

            $counter++;
        }

        $this->info($counter . ' number of discount records uploaded.');
    }

    private function getDiscounts()
    {

        $discounts = [];

        $discountAttributes = [];
        $discountAttributes['id'] = 101;
        $discountAttributes['type'] = 'percentage';
        $discountAttributes['amounts'] = [10];
        $discountAttributes['description'] = '%-os kedvezmény a termék árából';
        $discountAttributes['books'] = [1006];

        $discounts[] = $discountAttributes;

        $discountAttributes = [];
        $discountAttributes['id'] = 102;
        $discountAttributes['type'] = 'fix';
        $discountAttributes['amounts'] = [500];
        $discountAttributes['description'] = 'termék, fix ár kedvezmény a termék árából';
        $discountAttributes['books'] = [1002];

        $discounts[] = $discountAttributes;

        $discountAttributes = [];
        $discountAttributes['id'] = 103;
        $discountAttributes['type'] = 'package';
        $discountAttributes['amounts'] = [2, 1];
        $discountAttributes['description'] = 'X+Y csomag kedvezmény (a szettben szereplő legolcsóbb termék %-os kedvezményt kap)';
        $discountAttributes['publishers'] = ['PANEM'];
        $discountAttributes['relations'][] = ['discount_type_id' => 101, 'amounts' => [100]];

        $discounts[] = $discountAttributes;

        return $discounts;
    }
}
