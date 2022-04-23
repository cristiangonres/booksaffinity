@extends('layout')

@section('title', 'Book Details')

@section('content')

    <div class="m-4 p-2 shadow rounded border-bottom container border-top d-flex col-md-12 flex-shrink-0">
    <div class="row">
        <div class="col-md-3">
            <div class="pro-img-details">
                <img src="data:image/jpeg;base64,{{base64_encode($book['0']['cover'])}}" width="150" height="200" alt="portada">
            </div>

        </div>
        <div class="col-md-6">
            <h4 class="pro-d-title">

                    {{$book["0"]["title"]}}

            </h4>

            <div class="m-bot15"> <strong>Autor : </strong> <span class="amount-old">

                <?php
        $year = date('Y', strtotime($book["0"]["publi_date"]));
        $nauth = count($book["0"]["authors"]);
        for ($i = 0; $i < $nauth; $i++) {
            echo '<a href="/author/' . $book["0"]["authors"][$i]['id'] . '"  style="text-decoration:none" class="link-dark"> ' . $book["0"]["authors"][$i]["author_name"]
               . ' </a>';
            if ($nauth > 1 && $i < $nauth - 1) {
                echo 'y';
            }
        }

                ?>

            </span> </div>
            <div class="m-bot15"> <strong>Fecha publicación : </strong> <span class="amount-old"><a href="/booksbyyear/{{$year}}"> {{$book["0"]["publi_date"]}}</a></span> </div>
            <div class="m-bot15"> <strong>Pais : </strong> <span class="amount-old"><a href="/countrybook/{{ $book['0']['country_id'] }}"> {{$book["0"]["country"]['country_name']}}</a></span> </div>
            <div class="m-bot15"> <strong>Editorial : </strong> <span class="amount-old"></span> </div>
            <div class="m-bot15"> <strong>Paginas : </strong> <span class="amount-old">{{$book["0"]["pages"]}}</span> </div>
            <div class="m-bot15"> <strong>Tipo : </strong> <span class="amount-old"></span> </div>
            <div class="m-bot15"> <strong>ISBN : </strong> <span class="amount-old"></span> </div>

            <div class="product_meta">
                <span class="posted_in"> <strong>Categorias:</strong>
                    <?php

                        $ngen = count($book["0"]["genres"]);
                        for ($i = 0; $i < $ngen; $i++) {
                            echo '<a href="/genre/' . $book["0"]["genres"][$i]['id'] . '" style="text-decoration:none" class="link-info"> ' . $book["0"]["genres"][$i]['genre_name'] . '</a>';
                            if ($ngen > 1 && $i < $ngen - 1) {
                                echo ',';
                            }
                        }
                        ?>

                </span>

                <p>
                    <button class="btn btn-round btn-primary" type="button"><i class="fa fa-star"></i> Añadir a favoritos</button>
                </p>
            </div>

        </div>
        <div class="col-3 ratings text-center align-bottom border-start">
            <span class="badge bg-primary"> Puntuación:

            <?php


                $nrate = count($book["0"]["accounts"]);
                $rate = 0;
                for ($i = 0; $i < $nrate; $i++) {
                    $rate += $book["0"]["accounts"][$i]['pivot']['rate'];
                }
                $avgrate = $nrate > 0 ? round($rate / $nrate, 2) : 0;
                ?>
                {{$avgrate}}
                </span>
                <span class="badge bg-primary"> Votos:

                    {{count($book["0"]["accounts"])}}

                </span>
        </div>

        <div class="col-12">
        <div class="m-bot15"> <strong>Sinopsis : </strong> </div><br/>
            <p>
            {{$book["0"]["synopsis"]}}
            </p>

        </div>


    </div>


</div>

<div class="m-4 p-2 shadow rounded border-bottom container border-top d-flex col-md-12 flex-shrink-0">
    <div class="row m-0">
        <div class="row m-1 border-bottom">
        <div class="col-1 m-1 p-3">
        <img src="../img/random-user.jpg" width="65" height="65" alt="user-img">

        </div>

        <div class="m-bot15 col-4 align-self-center ">
            <strong>Iker Rivero </strong>
            <div class="m-bot15">
                <strong>Valoraciones: </strong> <span class="amount-old"> 26 </span>
                <strong>Opiniones: </strong> <span class="amount-old"> 6 </span>
            </div>

        </div>
        <div class="col-1 align-self-center">
        <span class="badge bg-primary "> Puntuación: 8.5 </span>
        </div>
        <div class="col-2"></div>
        <div class="col-3 align-self-end">
        <strong>Fecha publicación: </strong> <span class="amount-old">18/04/2022</span>
        </div>


        </div>


        <div class="col-12">
        <div class="m-1 p-1"> <strong> ¡¡Un libro INIGUALABLE!! </strong> </div><br/>
            <p>
            Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.
            </p>

        </div>


    </div>


</div>

@endsection
