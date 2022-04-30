<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Book;
use App\Models\Author;

class CountryController extends Controller
{
    function countries(){
        $countries=Country::all();
        $countries = emptyCountry($countries);
        return view('countries', compact('countries'));
    }



    function booksByCountry($id){
        $books=Book::all();
        return view('booksbycountry', compact('books', 'id'));
    }

    function authorsByCountry($id){
        $authors=Author::all();
        return view('authorsbycountry', compact('authors', 'id'));
    }
}
