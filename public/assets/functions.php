<?php

use Illuminate\Support\Collection;
use App\Models\BookGenre;
use App\Models\Book;


function filtering()
{
    $books = Book::all();
    $array= array();

    if(isset($_POST['category']) && $_POST['category']!="" ){

        foreach($books as $book){
        $ngen = count($book->genres);
        for ($i = 0; $i < $ngen; $i++) {
            if($book->genres[$i]['id'] == $_POST['category']){
                array_push($array, $book);
            }
        }
    }
    }else {
        $array = $books;
    }




    return $array;

}

function emptyGenre($genres){

    $bookGenres = BookGenre::all();
    $array= array();

    foreach ($genres as $genre){
        foreach ($bookGenres as $bookGenre){
           if ($genre->id == $bookGenre->genre_id) {
            array_push($array, $genre);
            break;
           }
        }

    }

    return $array;
}


function emptyCountry($countries){

    $books = Book::all();
    $array= array();

    foreach ($countries as $country){
        foreach ($books as $book){
           if ($country->id == $book->country_id) {
            array_push($array, $country);
            break;
           }
        }

    }

    return $array;
}

?>