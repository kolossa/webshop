<?php

namespace App\Http\Controllers;

use App\Book\IBookRepository;
use App\Cart\CartService;
use Illuminate\Http\Request;

class RemoveFromCartController extends Controller
{
    /**
     * @var CartService $cartService
     */
    protected $cartService;

    /**
     * @var  IBookRepository $bookRepository
     */
    protected $bookRepository;

    public function __construct(CartService $cartService, IBookRepository $bookRepository)
    {
        $this->cartService = $cartService;
        $this->bookRepository = $bookRepository;
    }

    public function __invoke(Request $request)
    {
        $book = $this->bookRepository->findByPk($request->input('bookId'));
        if ($book) {
            $this->cartService->removeBook($request->session()->getId(), $book);
            return ['msg' => $book->title . ' book removed from your cart!'];
        } else {
            throw new \Exception("Book not found!", 404);
        }
    }
}
