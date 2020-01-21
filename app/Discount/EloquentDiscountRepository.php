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

    public function findAllByBook(Book $book)
    {

        return Discount::select('discounts.*')
            ->join(Discount::TABLE_BOOKS_ASSIGN, 'discounts.id', '=', 'discount_id')
            ->where(Discount::TABLE_BOOKS_ASSIGN . '.book_id', $book->id)
            ->get();
    }

    public function findAllByPublisher(Publisher $publisher)
    {

        return Discount::select('discounts.*')
            ->join(Discount::TABLE_PUBLISHERS_ASSIGN, 'discounts.id', '=', 'discount_id')
            ->where(Discount::TABLE_PUBLISHERS_ASSIGN . '.publisher_id', $publisher->id)
            ->get();
    }

    public function getRelatedDiscounts(Discount $discount)
    {
        return Discount::select('discounts.*')
            ->join(Discount::TABLE_DISCOUNTS_ASSIGN, 'discounts.id', '=', 'related_discount_id')
            ->where(Discount::TABLE_DISCOUNTS_ASSIGN . '.discount_id', $discount->id)
            ->get();
    }
}
