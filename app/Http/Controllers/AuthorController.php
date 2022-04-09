<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;


class AuthorController extends Controller
{
    function showAllAuthors(){
        $authors=Author::all();
        return view('authors', compact('authors'));
    }

    function showOneAuthor($id){
        $author=Author::where('id', $id)
        ->get();
        return view('author', compact('author'));
    }
}
