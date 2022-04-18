<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\BookGenre;
use App\Models\Book;
//use App\Models\Book_Genre;

class GenreController extends Controller
{
    function showAllGenres(){
        $genres=Genre::all();
        $genres= emptyGenre($genres);

        return view('genres', compact('genres'));
    }

    function showOneGenre($id){
        $books=Book::all();
        return view('booksbygenre', compact('books', 'id'));
    }
}
