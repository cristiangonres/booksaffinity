<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Country;
use App\Models\Author;
use App\Models\Genre;
use App\Models\BookGenre;

class RoutingController extends Controller
{
   
    function home()
    {
        Paginator::defaultView('vendor\pagination\bootstrap-4');
        $data = Book::paginate(10);
        return view('home', compact('data'));

    }


    function book(){
        $books = Book::all();
        $countries = Country::all();
        $authors= Author::all();

        return view('book', compact('books', 'countries', 'authors'));

    }

    function filterBooks(){
        Paginator::defaultView('vendor\pagination\bootstrap-4');
        $genres = Genre::all();
        $data="";

        $genres = emptyGenre($genres);
        


        if(isset($_POST['filter'])){

            $array= filtering();
            $data = $this->paginate($array);

   
         }else{
            $data = Book::paginate(10);
         }

         return view('filteredlist', compact('data', 'genres'));

    }



    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }




}


