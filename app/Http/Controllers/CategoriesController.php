<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\BookGenre;
use App\Models\Book;
//use App\Models\Book_Genre;

class CategoriesController extends Controller
{
    function showAllCategories(){
        $categories=Genre::all();
        return view('categorias', compact('categories'));
    }

    function showOneCategories($id){
        $books=Book::all();
        return view('category', compact('books', 'id'));
    }
}
