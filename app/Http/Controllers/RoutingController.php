<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class RoutingController extends Controller
{
   function home(){
      $id= array();
      $nombre= array();
      $categoria= array();
      $precio= array();

      $books = Book::all();
      /*foreach($books as $book){
          echo $book->title . " - " . $book->publi_date . "<br>";
      }*/

      /*if(isset($_POST['filter'])){

         if(isset($_POST['ordering']) && $_POST['categoria']!="" ){

            if($_POST['ordering']=='asc'){
               $products = products::where('categoria',$_POST['categoria'])->orderBy('precio')->get();

            }elseif($_POST['ordering']=='dsc'){
            $products = products::where('categoria',$_POST['categoria'])->orderByDesc('precio')->get();
            }

         }elseif($_POST['categoria'] != "" && !isset($_POST['ordering']) ){

            $products = products::where('categoria',$_POST['categoria'])->get();

         }elseif(isset($_POST['ordering']) && $_POST['categoria'] == "" ){

            if($_POST['ordering']=='asc'){
               $products = products::orderBy('precio')->get();

            }elseif($_POST['ordering']=='dsc'){
               $products = products::orderByDesc('precio')->get();

            }
         }else{
            $products = products::all();
         }

      }else{
         $products = products::all();
      }*/

      
      /*foreach($products as $product){
         array_push($id, $product->id);
         array_push($nombre, $product->nombre_producto);
         array_push($categoria, $product->categoria);
         array_push($precio, $product->precio);
      }*/

       return view('home', compact('books'));

    }

}
