<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Author;


class AuthorController extends Controller
{
    function showAllAuthors(){
        Paginator::defaultView('vendor\pagination\bootstrap-4');
        $data=Author::query()
        ->when(request('search'), function ($query) {
            return $query->where('author_name', 'like', '%' . request ('search') . '%')
                ->orWhereHas('books', function ($q) {
                    $q->where('title', 'like', '%' . request ('search') . '%');
                });
        })
        ->paginate(10);
        return view('authors', compact('data'));
    }

    function showOneAuthor($id){
        $author=Author::where('id', $id)
        ->get();
        return view('author', compact('author'));
    }

}
