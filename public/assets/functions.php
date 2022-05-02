<?php

use Illuminate\Support\Collection;
use App\Models\BookGenre;
use App\Models\Book;


function filtering()
{
    $books = Book::all();
    $array= array();


    if((isset($_POST['category']) && $_POST['category']!="") || (isset($_POST['country']) && $_POST['country']!="") || (isset($_POST['yearFilm']) && $_POST['yearFilm']!="")){
        if($_POST['category']!=""  && $_POST['country']!="" && $_POST['yearFilm']!=""){
            foreach($books as $book){
            $ngen = count($book->genres);
                for ($i = 0; $i < $ngen; $i++) {
                    if($book->genres[$i]['id'] == $_POST['category'] && $book->country['id'] == $_POST['country'] && date("Y", strtotime($book->publi_date)) == $_POST['yearFilm']) {
                        array_push($array, $book);
                    }
                }
            }
        } elseif($_POST['category']!=""  && $_POST['country']!="" ){
            foreach($books as $book){
            $ngen = count($book->genres);
                for ($i = 0; $i < $ngen; $i++) {
                    if($book->genres[$i]['id'] == $_POST['category'] && $book->country['id'] == $_POST['country'] ) {
                        array_push($array, $book);
                    }
                }
            }
        }elseif($_POST['category']!=""  && $_POST['yearFilm']!=""){
            foreach($books as $book){
            $ngen = count($book->genres);
                for ($i = 0; $i < $ngen; $i++) {
                    if($book->genres[$i]['id'] == $_POST['category']  && date("Y", strtotime($book->publi_date)) == $_POST['yearFilm']) {
                        array_push($array, $book);
                    }
                }
            }
        }elseif($_POST['country']!="" && $_POST['yearFilm']!="" ){
            foreach($books as $book){
                    if( $book->country['id'] == $_POST['country'] && date("Y", strtotime($book->publi_date)) == $_POST['yearFilm'] ) {
                        array_push($array, $book);
                    }
                }
        } elseif ( $_POST['category']!=""){
            foreach($books as $book){
                $ngen = count($book->genres);
                for ($i = 0; $i < $ngen; $i++) {
                    if($book->genres[$i]['id'] == $_POST['category'] ) {
                        array_push($array, $book);
                    }
                }
            }
        }  elseif( $_POST['country']!="" ){
            foreach($books as $book){
                if($book->country['id'] == $_POST['country']) {
                    array_push($array, $book);
                }
            }
        } elseif( $_POST['yearFilm']!="" ){
            foreach($books as $book){
                if(date("Y", strtotime($book->publi_date)) == $_POST['yearFilm']) {
                    array_push($array, $book);
                }
            }
        } else {
        $array = $books;
    }
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
