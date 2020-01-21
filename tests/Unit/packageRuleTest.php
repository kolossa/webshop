<?php

namespace Tests\Unit;

use App\Book\Book;
use App\Discount\Discount;
use App\Discount\DiscountRulePackage;
use App\Discount\DiscountType;
use PHPUnit\Framework\TestCase;

class packageRuleTest extends TestCase
{
    /**
     * @var DiscountRulePackage $packageRule
     */
    protected $packageRule;

    protected $books = [];

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->packageRule = new DiscountRulePackage();

        $book1 = new Book();
        $book1->title = 1;
        $book1->price = 100;
        $book1->publisher_id = 1;
        $this->books[] = $book1;

        $book2 = new Book();
        $book2->title = 2;
        $book2->price = 200;
        $book2->publisher_id = 1;
        $this->books[] = $book2;

    }

    /**
     * @test
     */
    public function booksWithOtherPublisher()
    {
        $book3 = new Book();
        $book3->title = 2;
        $book3->price = 200;
        $book3->publisher_id = 2;
        $this->books[] = $book3;

        $this->expectException(\BadMethodCallException::class);

        $this->packageRule->getDiscountPrice($this->books, new Discount(), new \SplObjectStorage());

    }

    /**
     * @test
     */
    public function simpleFixTypeRelatedDiscount()
    {
        $discount = new Discount();
        $discount->amount1 = 1;
        $discount->amount2 = 1;

        $relatedDiscount = new Discount();
        $relatedDiscount->amount1 = 100;

        $relatedDiscountType = new DiscountType();
        $relatedDiscountType->type = DiscountType::TYPE_FIX;

        $map = new \SplObjectStorage();
        $map[$relatedDiscount] = $relatedDiscountType;

        $x = $this->packageRule->getDiscountPrice($this->books, $discount, $map);

        $this->assertEquals(100, $x);
    }

    /**
     * @test
     */
    public function simplePercentageTypeRelatedDiscount()
    {
        $discount = new Discount();
        $discount->amount1 = 1;
        $discount->amount2 = 1;

        $relatedDiscount = new Discount();
        $relatedDiscount->amount1 = 0.5;

        $relatedDiscountType = new DiscountType();
        $relatedDiscountType->type = DiscountType::TYPE_PERCENTAGE;

        $map = new \SplObjectStorage();
        $map[$relatedDiscount] = $relatedDiscountType;

        $x = $this->packageRule->getDiscountPrice($this->books, $discount, $map);

        $this->assertEquals(50, $x);
    }

    /**
     * @test
     */
    public function percentageAndFixTypeRelatedDiscount()
    {
        $discount = new Discount();
        $discount->amount1 = 1;
        $discount->amount2 = 1;

        $relatedDiscount1 = new Discount();
        $relatedDiscount1->amount1 = 0.5;

        $relatedDiscountType1 = new DiscountType();
        $relatedDiscountType1->type = DiscountType::TYPE_PERCENTAGE;

        $relatedDiscount2 = new Discount();
        $relatedDiscount2->amount1 = 100;

        $relatedDiscountType2 = new DiscountType();
        $relatedDiscountType2->type = DiscountType::TYPE_FIX;

        $map = new \SplObjectStorage();
        $map[$relatedDiscount1] = $relatedDiscountType1;
        $map[$relatedDiscount2] = $relatedDiscountType2;

        $x = $this->packageRule->getDiscountPrice($this->books, $discount, $map);

        $this->assertEquals(150, $x);
    }

    /**
     * @test
     */
    public function multiplePackageDiscount()
    {
        $book3 = new Book();
        $book3->title = 3;
        $book3->price = 300;
        $book3->publisher_id = 1;
        $this->books[] = $book3;

        $book4 = new Book();
        $book4->title = 4;
        $book4->price = 400;
        $book4->publisher_id = 1;
        $this->books[] = $book4;

        $discount = new Discount();
        $discount->amount1 = 1;
        $discount->amount2 = 1;

        $relatedDiscount = new Discount();
        $relatedDiscount->amount1 = 100;

        $relatedDiscountType = new DiscountType();
        $relatedDiscountType->type = DiscountType::TYPE_FIX;

        $map = new \SplObjectStorage();
        $map[$relatedDiscount] = $relatedDiscountType;

        $x = $this->packageRule->getDiscountPrice($this->books, $discount, $map);

        $this->assertEquals(200, $x);
    }

    /**
     * @test
     */
    public function emptyBookList()
    {

        $x = $this->packageRule->getDiscountPrice([], new Discount(), new \SplObjectStorage());

        $this->assertEquals(0, $x);
    }
}
