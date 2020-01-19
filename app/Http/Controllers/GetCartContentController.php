<?php

namespace App\Http\Controllers;

use App\Book\IBookRepository;
use App\Cart\CartService;
use Illuminate\Http\Request;

class GetCartContentController extends Controller
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

        $result = [];

        $content = $this->cartService->getContent($request->session()->getId());

        foreach ($content as $cartContent) {

            $row = [];

            $book = $this->bookRepository->findByPk($cartContent->book_id);

            $row['id'] = $book->id;
            $row['title'] = $book->title;

            $authorNames = [];
            foreach ($book->authors as $author) {
                $authorNames[] = $author->name;
            }

            $row['authors'] = $authorNames;

            $result[] = $row;

        }

        return $result;
    }
}
