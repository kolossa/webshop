<?php


namespace App\Cart;


use App\Book\Book;

class CartService
{
    /**
     * @var CartFactory $factory
     */
    protected $factory;

    /**
     * @var ICartRepository $cartRepository
     */
    protected $cartRepository;

    public function __construct(CartFactory $factory, ICartRepository $cartRepository)
    {
        $this->factory = $factory;
        $this->cartRepository = $cartRepository;
    }

    public function addBook(string $sessionId, Book $book)
    {

        $cart = $this->factory->create();
        $cart->session_id = $sessionId;
        $cart->book_id = $book->id;
        $this->cartRepository->persist($cart);
    }

    public function removeBook(string $sessionId, Book $book)
    {

        $cart = $this->cartRepository->findBySessionIdAndBook($sessionId, $book);

        if ($cart) {
            $this->cartRepository->delete($cart);
        }
    }

    public function getContent(string $sessionId)
    {

        return $this->cartRepository->findAllBySessionId($sessionId);
    }

    public function empty(string $sessionId)
    {

        $this->cartRepository->deleteAllBySessionId($sessionId);
    }
}
