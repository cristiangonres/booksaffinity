<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\DB;


class BookController extends Controller
{
    function books(){
        $books = Book::all();
        return view('books', compact('books'));

    }

    function bookdetail($id){
        $book=Book::where('id', $id)
        ->get();
        return view('bookdetail', compact('book'));
    }


}
