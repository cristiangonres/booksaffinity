<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\DB;


class BookController extends Controller
{
    function books(){

        $books = Book::query()
        ->with(['authors'])
        ->when(request('search'), function ($query) {
            return $query->where('title', 'like', '%' . request ('search') . '%')
                ->orWhereHas('authors', function ($q) {
                    $q->where('author_name', 'like', '%' . request ('search') . '%');
                });
        })
        ->paginate(5);

        return view('books', compact('books'));

    }

    function bookdetail($id){
        $book=Book::where('id', $id)
        ->get();
        return view('bookdetail', compact('book'));
    }

    function booksbyyears($year){
        $books=Book::whereYear('publi_date', $year)
        ->get();
        return view('booksbyyear', compact('books'));
    }



}
