<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Book\IBookRepository;

class GetBooksController extends Controller
{
	
	/**
	 * @var IBookRepository $bookRepository
	 */
	protected $bookRepository;
	
	public function __construct(IBookRepository $bookRepository)
    {
        $this->bookRepository=$bookRepository;
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke($offset, $limit, $column, $asc)
    {
        return $this->bookRepository->findAllWithPublisherAndAuthors((int)$offset, (int)$limit, $column, (bool)$asc);
    }

    
}
