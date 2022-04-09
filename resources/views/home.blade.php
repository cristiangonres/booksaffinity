@extends('layout')

@section('title', 'BooksAffinity')

@section('content')


<div class="row">
<?php

$admin=true;

      foreach($books as $book){

        $country = $countries->find($book->country_id)->country_name;

          echo '<div class="m-4 p-2 shadow rounded border-bottom container border-top d-flex col-md-12 flex-shrink-0">

          <div id="position">'.$book->id.'</div>
          <div class="container">
              <div class="row justify-content-start">
                  <div class="col-3 portada ">
                      <a href="#"><img src="data:image/jpeg;base64,'.base64_encode($book->cover).'" width="150" height="200" alt="portada"></a>
                  </div>
                  <div class="col-6">
                      <ul class="list-unstyled">
                          <li>Titulo: <a href="#" style="text-decoration:none" class="link-dark">'. $book->title .'</a></li>
                          <li>Autor: <a href="#" style="text-decoration:none" class="link-dark">'.$book->authors["0"]["author_name"].'</a></li></li>
                          <li>Fecha publicado: <a href="#" style="text-decoration:none" class="link-dark">'.$book->publi_date.'</a></li></li>
                          <li>Pais: <a href="#" style="text-decoration:none" class="link-dark">'.$country.'</a></li></li>
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


</div>




@endsection
