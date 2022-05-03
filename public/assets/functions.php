<?php

use Illuminate\Support\Collection;
use App\Models\BookGenre;
use App\Models\Book;

$orderBy = 'title';

function filtering()
{
    if(isset($_POST['orderBy'])){
        $orderBy=$_POST['orderBy'];

    } else {$orderBy = 'title'; }
    $books = Book::all()->sortByDesc($orderBy);
    $array= array();


    if((isset($_POST['category']) && $_POST['category']!="") || (isset($_POST['country']) && $_POST['country']!="") || (isset($_POST['yearDesde']) && $_POST['yearDesde']!="") || (isset($_POST['yearHasta']) && $_POST['yearHasta']!="")){
        if($_POST['category']!=""  && $_POST['country']!="" && $_POST['yearDesde']!="" && $_POST['yearHasta']!="" ){
            foreach($books as $book){
            $ngen = count($book->genres);
            $datebook = date("Y", strtotime($book->publi_date));
                for ($i = 0; $i < $ngen; $i++) {
                    if($book->genres[$i]['id'] == $_POST['category'] && $book->country['id'] == $_POST['country'] && $datebook >= $_POST['yearDesde'] && $datebook <= $_POST['yearHasta']) {
                        array_push($array, $book);
                    }
                }
            }
        }elseif($_POST['category']!=""  && $_POST['country']!="" && $_POST['yearDesde']!=""){
            foreach($books as $book){
            $ngen = count($book->genres);
            $datebook = date("Y", strtotime($book->publi_date));
                for ($i = 0; $i < $ngen; $i++) {
                    if($book->genres[$i]['id'] == $_POST['category'] && $book->country['id'] == $_POST['country'] && $datebook >= $_POST['yearDesde']) {
                        array_push($array, $book);
                    }
                }
            }
        } elseif($_POST['category']!=""  && $_POST['country']!="" && $_POST['yearHasta']!=""){
            foreach($books as $book){
            $ngen = count($book->genres);
            $datebook = date("Y", strtotime($book->publi_date));
                for ($i = 0; $i < $ngen; $i++) {
                    if($book->genres[$i]['id'] == $_POST['category'] && $book->country['id'] == $_POST['country'] && $datebook <= $_POST['yearHasta']) {
                        array_push($array, $book);
                    }
                }
            }
        }elseif($_POST['category']!=""  && $_POST['yearDesde']!="" && $_POST['yearHasta']!=""){
            foreach($books as $book){
            $ngen = count($book->genres);
            $datebook = date("Y", strtotime($book->publi_date));
                for ($i = 0; $i < $ngen; $i++) {
                    if($book->genres[$i]['id'] == $_POST['category']  && $datebook >= $_POST['yearDesde'] && $datebook <= $_POST['yearHasta'])    {
                        array_push($array, $book);
                    }
                }
            }
        } elseif($_POST['category']!=""  && $_POST['yearDesde']!="" ){
            foreach($books as $book){
            $ngen = count($book->genres);
            $datebook = date("Y", strtotime($book->publi_date));
                for ($i = 0; $i < $ngen; $i++) {
                    if($book->genres[$i]['id'] == $_POST['category']  && $datebook >= $_POST['yearDesde'])    {
                        array_push($array, $book);
                    }
                }
            }
        }elseif($_POST['category']!=""   && $_POST['yearHasta']!=""){
            foreach($books as $book){
            $ngen = count($book->genres);
            $datebook = date("Y", strtotime($book->publi_date));
                for ($i = 0; $i < $ngen; $i++) {
                    if($book->genres[$i]['id'] == $_POST['category'] && $datebook <= $_POST['yearHasta'])    {
                        array_push($array, $book);
                    }
                }
            }
        }elseif($_POST['country']!="" && $_POST['yearDesde']!="" && $_POST['yearHasta']!=""){
            foreach($books as $book){
                $datebook = date("Y", strtotime($book->publi_date));
                    if( $book->country['id'] == $_POST['country'] && $datebook >= $_POST['yearDesde'] && $datebook <= $_POST['yearHasta']) {
                        array_push($array, $book);
                    }
                }
        } elseif($_POST['country']!="" && $_POST['yearDesde']!="" ){
            foreach($books as $book){
                $datebook = date("Y", strtotime($book->publi_date));
                    if( $book->country['id'] == $_POST['country'] && $datebook >= $_POST['yearDesde']) {
                        array_push($array, $book);
                    }
                }
        }elseif($_POST['country']!=""  && $_POST['yearHasta']!=""){
            foreach($books as $book){
                $datebook = date("Y", strtotime($book->publi_date));
                    if( $book->country['id'] == $_POST['country'] && $datebook <= $_POST['yearHasta']) {
                        array_push($array, $book);
                    }
                }
        }elseif($_POST['category']!=""  && $_POST['country']!="" ){
            foreach($books as $book){
            $ngen = count($book->genres);
                for ($i = 0; $i < $ngen; $i++) {
                    if($book->genres[$i]['id'] == $_POST['category'] && $book->country['id'] == $_POST['country'] ) {
                        array_push($array, $book);
                    }
                }
            }
        }elseif ( $_POST['category']!=""){
            foreach($books as $book){
                $ngen = count($book->genres);
                for ($i = 0; $i < $ngen; $i++) {
                    if($book->genres[$i]['id'] == $_POST['category'] ) {
                        array_push($array, $book);
                    }
                }
            }
        }elseif( $_POST['country']!="" ){
            foreach($books as $book){
                if($book->country['id'] == $_POST['country']) {
                    array_push($array, $book);
                }
            }
        }elseif( $_POST['yearDesde']!="" ){
            foreach($books as $book){
                $datebook = date("Y", strtotime($book->publi_date));
                if($datebook >= $_POST['yearDesde']) {
                    array_push($array, $book);
                }
            }
        } elseif( $_POST['yearHasta']!="" ){
            foreach($books as $book){
                $datebook = date("Y", strtotime($book->publi_date));
                if($datebook <= $_POST['yearHasta']) {
                    array_push($array, $book);
                }
            }
        }



    } else {
        foreach($books as $book){
            array_push($array, $book);
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
