<?php

use Illuminate\Support\Collection;
use App\Models\Book;


function filtering()
{
    $books = Book::all();
    $array= array();

    if(isset($_POST['category'])){

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

?>