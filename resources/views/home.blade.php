@extends('layout')

@section('title', 'BooksAffinity')

@section('content')


<div class="row">
<?php

$admin=true;

      foreach($books as $book){
        //$countries = Country::find($book->country_id)->country_name
        
        var_dump($book->country);
        

        $countryname;
          //echo $book->title . " - " . $book->publi_date . "<br>";
         /* foreach($countries as $country){


              if ($book->country_id == $country->country_id){
                  $countryname = $country->country_name;
              }
          }*/

          echo '<div class="m-4 p-2 shadow rounded border-bottom container border-top d-flex col-md-12 flex-shrink-0">

          <div id="position">'.$book->book_id.'</div>
          <div class="container">
              <div class="row justify-content-start">
                  <div class="col-3 portada ">
                      <a href="#"><img src="data:image/jpeg;base64,'.base64_encode($book->cover).'" width="150" height="200" alt="portada"></a>
                  </div>
                  <div class="col-6">
                      <ul class="list-unstyled">
                          <li>Titulo: <a href="#" style="text-decoration:none" class="link-dark">'.$book->title.'</a></li>
                          <li>Autor: <a href="#" style="text-decoration:none" class="link-dark">'.$book->author_id.'</a></li></li>
                          <li>Fecha publicado: <a href="#" style="text-decoration:none" class="link-dark">'.$book->publi_date.'</a></li></li>
                          <li>Pais: <a href="#" style="text-decoration:none" class="link-dark">'.$book->country.'</a></li></li>
                          <li>Generos:</li>
                          <a href="#" style="text-decoration:none" class="link-info">xxxx</a>, <a href="#" style="text-decoration:none" class="link-info">xxxx</a>, <a href="#"style="text-decoration:none" class="link-info">xxxx</a>

                      </ul>
                  </div>
                  <div class="col-3 ratings text-center align-bottom border-start">

                          <span class="badge bg-primary">9,0</span>
                          <span class="badge bg-primary">172.184</span>

                  </div>
              </div>
          </div>

      </div>';


    }

?>


<div class="m-4 p-2 shadow rounded border-bottom container border-top d-flex col-md-12 flex-shrink-0">

    <div id="position">1</div>
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-3 portada ">
                <a href="#"><img src="../img/portada.png" width="150" height="200" alt="portada"></a>
            </div>
            <div class="col-6">
                <ul class="list-unstyled">
                    <li>Titulo: <a href="#" style="text-decoration:none" class="link-dark">xxxxxxx</a></li>
                    <li>Autor: <a href="#" style="text-decoration:none" class="link-dark">xxxxxxx</a></li></li>
                    <li>Año: <a href="#" style="text-decoration:none" class="link-dark">xxxx</a></li></li>
                    <li>Pais: <a href="#" style="text-decoration:none" class="link-dark">xxxxxxx</a></li></li>
                    <li>Generos:</li>
                    <a href="#" style="text-decoration:none" class="link-info">xxxx</a>, <a href="#" style="text-decoration:none" class="link-info">xxxx</a>, <a href="#"style="text-decoration:none" class="link-info">xxxx</a>

                </ul>
            </div>
            <div class="col-3 ratings text-center align-bottom border-start">

                    <span class="badge bg-primary">9,0</span>
                    <span class="badge bg-primary">172.184</span>

            </div>
        </div>
    </div>

</div>




</div>



@endsection
