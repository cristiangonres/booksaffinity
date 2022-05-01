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

                <button class="btn btn-round btn-primary m-2" type="button" onclick="add_coment()">Añadir comentario</button>
        </div>

        <div class="col-12">
        <div class="m-bot15"> <strong>Sinopsis : </strong> </div><br/>
            <p>
            {{$book["0"]["synopsis"]}}
            </p>

        </div>


    </div>


</div>

<div id="comentForm" class="d-none">

  <div class="m-4 p-2 shadow rounded border-bottom container border-top d-flex col-md-12 flex-shrink-0">
        <form class="p-5 ml-1 list-group-item" action="/book/{{$book['0']['id']}}" method="post">
            @csrf


            <div class="col-12">
                <h4> Introduce un nuevo comentario: </h4>
                <div class="m-1 p-1 col-5"> 
                    <label class="form-label" for="title">Titulo: </label>
                    <input type="text" name="title" class="form-control" value='' required />
                </div>
                <br/>
                <label class="form-label" for="comment">Comentario:</label>
                <textarea class="form-control" name="comment" rows="5" cols="100" required></textarea>
                <div class="m-2 p-1 col-5">
                    <button type="submit" name="save" class="btn btn-success btn-block mb-4">Guardar comentario</button>
                </div>
            </div>

        </form>
    </div> 
</div>

<script>
function add_coment() {

let form = document.getElementById("comentForm");
form.removeAttribute("class");
}
</script>


<?php
$nrate = count($book["0"]["accounts"]);
$n=0;
for ($i = 0; $i < $nrate; $i++) {
    
    if($book["0"]["accounts"][$i]['pivot']['date_review'] != ""){
        $n += 1;

    }
}

for ($i = 0; $i < $n; $i++) {

echo '<div class="m-4 p-2 shadow rounded border-bottom container border-top d-flex col-md-12 flex-shrink-0">
    <div class="row m-0">
        <div class="row m-1 border-bottom">
        <div class="col-1 m-1 p-3">
        <img src="../img/random-user.jpg" width="65" height="65" alt="user-img">

        </div>

        <div class="m-bot15 col-4 align-self-center ">
            <strong>'.$userData[$i]["username"].'</strong>
            <div class="m-bot15">
                <strong>Valoraciones: </strong> <span class="amount-old"> '.$userData[$i]["rates"].' </span>
                <strong>Opiniones: </strong> <span class="amount-old"> '.$userData[$i]["coments"].' </span>
            </div>

        </div>
        <div class="col-1 align-self-center">
        <span class="badge bg-primary "> Puntuación: '.$userData[$i]["rate"].' </span>
        </div>
        <div class="col-2"></div>
        <div class="col-3 align-self-end">
        <strong>Fecha publicación: </strong> <span class="amount-old">'.$userData[$i]["date_review"].'</span>
        </div>


        </div>


        <div class="col-12">
        <div class="m-1 p-1"> <strong> '.$userData[$i]["title_review"].' </strong> </div><br/>
            <p>
            '.$userData[$i]["review"].'
            </p>

        </div>


    </div>


</div>';
}
?>

@endsection
