<?php

namespace App\Http\Controllers;

use App\Http\Controllers\RoutingController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Author;
use App\Models\AuthorBook;
use App\Models\BookGenre;


class BookManageController extends Controller
{
    function emptyRet(){
        $countries = Country::all();
        $genres = Genre::all();

        return view('bookmanage', compact('countries', 'genres'));
    }

    function insert(Request $request){

        if(isset($_POST["save"])){

            $title=$request->get('title');
            $titleBD=Book::where('title', $title)->get('title');

            $imageContent="";
            
            if($_FILES["cover"]["tmp_name"] !== ""){
                $image=$_FILES["cover"]["tmp_name"];
                $imageContent=file_get_contents($image);
            }

                //Titulo repetido.
                if($titleBD=='[]' || $request->get('id')){

                    $newBook=new Book();
                    if($request->get('id')){
                        $newBook = Book::find($request->get('id'));
                    }
                    $newBook->title=$title;
                    $newBook->publi_date=$request->get('pubDate');
                    $newBook->country_id=$request->get('country');
                    $newBook->synopsis=$request->get('synopsis');
                    $newBook->pages=$request->get('pages');
                    if($imageContent!=""){
                        $newBook->cover=$imageContent;
                    }
                    

                    $newBook->save();

                    $id=Book::where('title', $title)->get('id');

                    $exit = true;
                    $i=1;

                    while($exit){

                        $genre=$request->get('genre'.$i);

                        $i++;

                        if($genre == ""){
                            $exit = false;
                        }else{
                            $newGenre=new BookGenre();
                            $newGenre->genre_id=$genre;
                            $newGenre->book_id=$id[0]["id"];
                            $newGenre->save();

                        }
                    }

                    $exit = true;
                    $i=1;

                    while($exit){

                        $author=$request->get("author".$i);
                        $authorId=Author::where('author_name', $author)->get("id");

                        if($author == "" || $authorId =='[]' ){
                            $exit = false;
                        }else{
                            $newAuthor=new AuthorBook();
                            $newAuthor->author_id=$authorId[0]["id"];
                            $newAuthor->book_id=$id[0]["id"];
                            $newAuthor->save();
                        }
                        $i++;
                    }
                    
                    return BookManageController::emptyRet();

                } else {
                    echo '<script language="javascript">';
                    echo 'alert("Titulo repetido")';
                    echo '</script>';

                    return BookManageController::emptyRet();
                }

        }
        if(isset($_POST["delete"])){
            if($request->get('id')){
                $deleteBook = Book::find($request->get('id'));
                $deleteBook->delete();
                echo '<script language="javascript">';
                echo 'alert("Libro eliminado")';
                echo '</script>';
                return BookManageController::emptyRet();
            }

        }

    }

    function editBook($id){
    $book=Book::where('id', $id)
    ->get();

    $countries = Country::all();
    $genres = Genre::all();

    return view('bookmanage', compact('countries', 'genres', 'book'));
    }
}
