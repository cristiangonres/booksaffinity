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
        $data = Book::query()
        ->with(['authors'])
        ->when(request('search'), function ($query) {
            return $query->where('title', 'like', '%' . request ('search') . '%')
            ->orWhere('original_title', 'like', '%' . request ('search') . '%')
                ->orWhereHas('authors', function ($q) {
                    $q->where('author_name', 'like', '%' . request ('search') . '%');
                });
        })
        ->paginate(5);

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
        $countries = Country::all();
        $data="";
        $buleano= true;

        $genres = emptyGenre($genres);
        $countries = emptyCountry($countries);


        if(isset($_POST['filter'])){

            $data= filtering();
            /*$data = $this->paginateion($array)*/;
   $buleano=false;
         
         }else{
            echo "cosas";
                $orderBy= "title";
            
            $data = Book::orderBy($orderBy, 'asc')
            ->paginate(10);
         }

         return view('filteredlist', compact('data', 'genres', 'countries', 'buleano'));

    }



    public function paginateion($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }




}


