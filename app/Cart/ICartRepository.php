<?php


namespace App\Cart;


use App\Book\Book;

interface ICartRepository
{
    public function persist(Cart $cart);

    public function findBySessionIdAndBook(string $sessionId, Book $book);

    public function delete(Cart $cart);

    public function findAllBySessionId(string $sessionId);

    public function deleteAllBySessionId(string $sessionId);
}
