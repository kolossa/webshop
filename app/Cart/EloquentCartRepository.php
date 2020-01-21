<?php


namespace App\Cart;


use App\Book\Book;

/**
 * Class EloquentCartRepository
 * @package App\Cart
 */
class EloquentCartRepository implements ICartRepository
{
    public function persist(Cart $cart)
    {

        $cart->save();
    }

    public function findBySessionIdAndBook(string $sessionId, Book $book)
    {

        return Cart::where('session_id', $sessionId)->where('book_id', $book->id)->first();
    }

    public function delete(Cart $cart)
    {

        $cart->delete();
    }

    public function findAllBySessionId(string $sessionId)
    {

        return Cart::where('session_id', $sessionId)->get();
    }

    public function deleteAllBySessionId(string $sessionId)
    {
        Cart::where('session_id', $sessionId)->delete();
    }
}
