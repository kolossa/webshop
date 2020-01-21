<?php

namespace App\Book;

/**
 * Class BookFactory
 * @package App\Book
 */
class BookFactory
{

    public function create(): Book
    {

        return new Book();
    }
}
