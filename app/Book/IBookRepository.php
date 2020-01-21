<?php

namespace App\Book;

use App\Author\Author;

/**
 * Interface IBookRepository
 * @package App\Book
 */
interface IBookRepository
{

    public function persist(\App\IEntity $entity);

    public function count(): int;

    public function assignAuthorToBook(Book $book, Author $author);

    public function findByPk($id);

    public function findAllWithPublisherAndAuthors($offset, $limit, $order, $asc = true);
}
