<?php

namespace App\Author;

/**
 * Class AuthorFactory
 * @package App\Author
 */
class AuthorFactory
{

    public function create(): Author
    {

        return new Author();
    }
}
