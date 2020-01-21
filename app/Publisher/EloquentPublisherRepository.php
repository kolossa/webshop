<?php

namespace App\Publisher;

use App\Book\Book;

class EloquentPublisherRepository implements IPublisherRepository
{

    public function persist(\App\IEntity $entity)
    {

        $entity->save();
    }


    public function findByName($name)
    {

        return Publisher::where('name', $name)->first();
    }


    public function findPublisherByBook(Book $book)
    {
        return Publisher::where('id', $book->publisher_id)->first();
    }
}
