<?php

namespace App\Http\Controllers;

use App\Http\Controllers\RoutingController;
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

        $title=$request->get('title');        
        $titleBD=Book::where('title', $title)->get('title');

        $check = getimagesize($_FILES["cover"]["tmp_name"]);

        if($check !== false){

            $image = $_FILES["cover"]["tmp_name"];
            $imgContent = addslashes(file_get_contents($image));
        
            //Titulo repetido.
            if($titleBD=='[]'){
                
                $newBook=new Book();
                $newBook->title=$title;
                $newBook->publi_date=$request->get('pubDate'); 
                $newBook->country_id=$request->get('country');
                $newBook->synopsis=$request->get('synopsis');
                $newBook->pages=$request->get('pages');
                $newBook->cover=$imgContent;
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

                    if($author == ""){
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
                return view('bookmanage')->with('El titulo del libro ya existe');
            }
    }else {
        return view('bookmanage')->with('La imagen no se ha podido subir');
    }
        
        
    }
}
