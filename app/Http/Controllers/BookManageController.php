<?php

namespace App\Http\Controllers;

use App\Http\Controllers\RoutingController;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Country;
use App\Models\Genre;


class BookManageController extends Controller
{
    function empty(){
        $countries = Country::all();
        $genres = Genre::all();

        return view('bookmanage', compact('countries', 'genres'));
    }

    function insert(Request $request){

        $title=$request->get('title');        
        $titleBD=Book::where('title', $title)->get('title');

        $check = getimagesize($_FILES["cover"]["tmp_name"]);

        if($check !== false){

            $image = $_FILES['cover']['tmp_name'];
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


                                return view('bookmanage')->with('Nuevo usuario registrado');

            } else {
                return view('bookmanage')->with('El titulo del libro ya existe');
            }
    }else {
        return view('bookmanage')->with('La imagen no se ha podido subir');
    }
        
        
    }
}
