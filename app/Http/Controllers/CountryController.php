<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Book;

class CountryController extends Controller
{
    function countries(){
        $countries=Country::all();
        return view('countries', compact('countries'));
    }

    function booksByCountry($id){
        $books=Book::all();
        return view('booksbycountry', compact('books', 'id'));
    }
}
