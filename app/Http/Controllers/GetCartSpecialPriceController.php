<?php

namespace App\Http\Controllers;

use App\Book\IBookRepository;
use App\Cart\CartPriceService;
use App\Cart\CartService;
use Illuminate\Http\Request;

class GetCartSpecialPriceController extends Controller
{
    /**
     * @var CartPriceService $cartPriceService
     */
    protected $cartPriceService;

    /**
     * @var CartService $cartService
     */
    protected $cartService;

    /**
     * @var IBookRepository $bookRepository
     */
    protected $bookRepository;

    /**
     * GetCartSpecialPriceController constructor.
     * @param CartPriceService $cartPriceService
     * @param CartService $cartService
     * @param IBookRepository $bookRepository
     */
    public function __construct(CartPriceService $cartPriceService, CartService $cartService, IBookRepository $bookRepository)
    {
        $this->cartPriceService = $cartPriceService;
        $this->cartService = $cartService;
        $this->bookRepository = $bookRepository;
    }


    public function __invoke(Request $request)
    {
        $content = $this->cartService->getContent($request->session()->getId());

        $books = [];
        foreach ($content as $c) {
            $books[] = $this->bookRepository->findByPk($c->book_id);
        }

        return $this->cartPriceService->getSpecialPrice($books);
    }
}
