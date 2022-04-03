<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Country;
use App\Models\Author;

class RoutingController extends Controller
{
    function home()
    {
        $books = Book::all();
        $countries = Country::all();

        return view('home', compact('books', 'countries'));

    }

    function book(){
        $books = Book::all();
        $countries = Country::all();
        $authors= Author::all();

        return view('book', compact('books', 'countries', 'authors'));

    }


}


