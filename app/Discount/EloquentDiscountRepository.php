<?php


namespace App\Discount;


use App\Book\Book;
use App\Publisher\Publisher;

class EloquentDiscountRepository implements IDiscountRepository
{
    public function persist(\App\IEntity $entity)
    {
        $entity->save();
    }

    public function assignBook(Discount $discount, Book $book)
    {

        $discount->books()->attach($book->id);
    }

    public function assignPublisher(Discount $discount, Publisher $publisher)
    {

        $discount->publishers()->attach($publisher->id);
    }

    public function assignRelatedDiscount(Discount $discount, Discount $relatedDiscount)
    {

        $discount->relatedDiscounts()->attach($relatedDiscount->id);
    }
}
