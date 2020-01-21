<?php


namespace App\Discount;


use App\Book\Book;
use App\Publisher\Publisher;

interface IDiscountRepository
{
    public function persist(\App\IEntity $entity);

    public function assignBook(Discount $discount, Book $book);

    public function assignPublisher(Discount $discount, Publisher $publisher);

    public function assignRelatedDiscount(Discount $discount, Discount $relatedDiscount);

    public function findAllByBook(Book $book);

    public function findAllByPublisher(Publisher $publisher);

    public function getRelatedDiscounts(Discount $discount);
}
