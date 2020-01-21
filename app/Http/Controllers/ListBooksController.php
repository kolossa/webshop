<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListBooksController extends Controller
{
    public function __invoke()
    {

        return view('books.list', []);
    }
}
