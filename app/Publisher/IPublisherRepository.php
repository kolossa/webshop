<?php

namespace App\Publisher;

use App\Book\Book;

interface IPublisherRepository
{

    public function persist(\App\IEntity $entity);

    public function findByName($name);

    public function findPublisherByBook(Book $book);
}
