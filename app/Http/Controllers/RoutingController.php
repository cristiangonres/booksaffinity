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
        $books = Book::paginate(5);
        return view('home', compact('books'));

    }


    function book(){
        $books = Book::all();
        $countries = Country::all();
        $authors= Author::all();

        return view('book', compact('books', 'countries', 'authors'));

    }


}


