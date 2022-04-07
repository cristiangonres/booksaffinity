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
        $authors=Author::all();
        return view('author', compact('authors', 'id'));
    }
}
