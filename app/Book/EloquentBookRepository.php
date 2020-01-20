<?php

namespace App\Book;

use App\Author\Author;
use App\Publisher\Publisher;

class EloquentBookRepository implements IBookRepository
{

    public function persist(\App\IEntity $entity)
    {

        $entity->save();
    }

    public function count(): int
    {

        return Book::get()->count();
    }

    public function assignAuthorToBook(Book $book, Author $author)
    {

        $book->authors()->attach($author->id);
    }

    public function findByPk($id)
    {

        return Book::find($id);
    }

    public function findAllWithPublisherAndAuthors($offset, $limit, $order, $asc = true)
    {

        return Book::with(['publisher.discounts.relatedDiscounts', 'authors', 'discounts.relatedDiscounts'])
            ->orderBy($order, $asc ? 'asc' : 'desc')
            ->offset($offset)
            ->limit($limit)
            ->get();
    }

    public function getPublisher(Book $book)
    {
        return Publisher::where('id', $book->publisher_id)->first();
    }
}
