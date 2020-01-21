<?php

namespace App\Author;

/**
 * Interface IAuthorRepository
 * @package App\Author
 */
interface IAuthorRepository
{

    public function persist(\App\IEntity $entity);

    public function findByName($name);
}
