@extends('layout')

@section('title', 'Book Details')

@section('content')


<?php

$id=1;
$thisBook;

foreach ($books as $book){
    if($book->id == $id){
        $thisBook=$book;
    }
}

$country = $countries->find($thisBook->country_id)->country_name;

?>


    <div class="m-4 p-2 shadow rounded border-bottom container border-top d-flex col-md-12 flex-shrink-0">
    <div class="row">    
        <div class="col-md-3">
            <div class="pro-img-details">
                <img src="data:image/jpeg;base64,{{base64_encode($thisBook->cover)}}" width="150" height="200" alt="portada">
            </div>

        </div>
        <div class="col-md-6">
            <h4 class="pro-d-title">
                <a href="#" class="">
                    {{$thisBook->title}}
                </a>
            </h4>

            <div class="m-bot15"> <strong>Autor : </strong> <span class="amount-old">{{$thisBook->authors["0"]["author_name"]}}</span> </div>
            <div class="m-bot15"> <strong>Fecha publicación : </strong> <span class="amount-old">{{$thisBook->publi_date}}</span> </div>
            <div class="m-bot15"> <strong>Pais : </strong> <span class="amount-old">{{$country}}</span> </div>
            <div class="m-bot15"> <strong>Editorial : </strong> <span class="amount-old">{{$thisBook->title}}</span> </div>
            <div class="m-bot15"> <strong>Paginas : </strong> <span class="amount-old"></span> </div>
            <div class="m-bot15"> <strong>Tipo : </strong> <span class="amount-old">{{$thisBook->pages}}</span> </div>
            <div class="m-bot15"> <strong>ISBN : </strong> <span class="amount-old"></span> </div>

            <div class="product_meta">
                <span class="posted_in"> <strong>Categorias:</strong> <a rel="tag" href="#">Drama</a>, <a rel="tag" href="#">Terror</a>,
                <a rel="tag" href="#">Misterio</a>.</span>

                <p>
                    <button class="btn btn-round btn-primary" type="button"><i class="fa fa-star"></i> Añadir a favoritos</button>
                </p>
            </div>

        </div>
        <div class="col-3 ratings text-center align-bottom border-start">

            <span class="badge bg-primary">9,0</span>
            <span class="badge bg-primary">172.184</span>

        </div>

        <div class="col-12">
        <div class="m-bot15"> <strong>Sinopsis : </strong> </div><br/>
            <p>
            {{$thisBook->synopsis}}
            </p>

        </div>


    </div>
</div>

@endsection