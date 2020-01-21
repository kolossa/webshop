<?php

namespace App\Http\Controllers;

use App\Book\BookPriceService;
use \App\Book\IBookRepository;

class GetBooksController extends Controller
{

    /**
     * @var IBookRepository $bookRepository
     */
    protected $bookRepository;

    /**
     * @var BookPriceService $bookPriceService
     */
    protected $bookPriceService;

    public function __construct(IBookRepository $bookRepository, BookPriceService $bookPriceService)
    {
        $this->bookRepository = $bookRepository;
        $this->bookPriceService = $bookPriceService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke($offset, $limit, $column, $asc)
    {
        $result = [];

        $books = $this->bookRepository->findAllWithPublisherAndAuthors((int)$offset, (int)$limit, $column, (bool)$asc);

        foreach ($books as $book) {
            $specialPrice = $this->bookPriceService->getSpecialPrice($book);
            $bookAttributes = [];
            $bookAttributes['id'] = $book->id;
            $bookAttributes['publisher'] = $book->publisher->name;
            $bookAttributes['authors'] = [];
            foreach ($book->authors as $author) {
                $bookAttributes['authors'][] = $author->name;
            }
            $bookAttributes['title'] = $book->title;
            $bookAttributes['catalogPrice'] = $book->price;
            $bookAttributes['specialPrice'] = $specialPrice;

            $result[] = $bookAttributes;
        }

        return $result;
    }


}
