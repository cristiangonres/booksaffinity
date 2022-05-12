@extends('layout')

@section('title', 'Book Details')

@section('content')

<?php
    if(session_status()==1){
      session_start();
    }

    $admin=false;
    $user=false;
    $master=false;

    if(isset($_SESSION["rol"])){
      if($_SESSION["rol"] == "admin" ){
        $admin=true;
        $user=true;
      }elseif($_SESSION["rol"] == "user"){
        $user=true;
      }elseif($_SESSION["rol"] == "master"){
        $master=true;
        $admin=true;
        $user=true;
      }
    }
    ?>

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
                    if(session_status()==1){
                        session_start();
                      }
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
            <div class="m-bot15"> <strong>Título Original : </strong> <span class="amount-old">{{$book["0"]["original_title"]}}</span> </div>
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
                <?php
                if($user){
                    echo '                <p>
                    <button class="btn btn-round btn-primary" type="button"><i class="fa fa-star"></i> Añadir a favoritos</button>
                </p>';
                }
                ?>
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

                <?php
                if($user){
                    echo '<button class="btn btn-round btn-primary m-2" type="button" onclick="add_coment()">Añadir comentario</button>';
                }
                ?>
                
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
        <form id="original" class="p-5 ml-1 list-group-item" action="/book/{{$book['0']['id']}}" method="post">
            @csrf


            <div class="col-12">
                <h4> Introduce un nuevo comentario: </h4>
                <div class="row m-1 p-1 col-12">
                    <div class="m-1 p-1 col-5">
                            <label class="form-label" for="title">Titulo: </label>
                            <input type="text" name="title" class="form-control" value='' required />
                    </div>
                    <div class="m-1 p-1 col-2">
                    </div>
                    <div class="m-1 p-1 col-2">
                        <label class="form-label" for="rate">Valoración: </label>
                        <input type="number" class="form-control" name="rate" min="0" max="10"/>
                    </div>

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
let comented = false;
let username = "";
let rate=0;
let title="";
let comment="";

    <?php
        $nrate = count($book["0"]["accounts"]);
        $n=0;
        for ($i = 0; $i < $nrate; $i++) {

            if($book["0"]["accounts"][$i]['pivot']['date_review'] != ""){
                $n += 1;

            }
        }
        for ($i = 0; $i < $n; $i++) {
            if(isset($_SESSION['user_id'])){

                if($userData[$i]["user_id"]==$_SESSION['user_id']){
                    echo "comented= true;";
                    echo "username = '".$userData[$i]["username"]."';";
                    echo "rate = '".$userData[$i]["rate"]."';";
                    echo "title = '".$userData[$i]["title_review"]."';";
                    echo "comment = '".$userData[$i]["review"]."';";
                }
            }

        }

    ?>


if(!comented){
    let form = document.getElementById("comentForm");
    form.removeAttribute("class");
    form.scrollIntoView();
}else{

    let div= document.getElementById(username);
    while (div.firstChild) {
        div.removeChild(div.firstChild);
    }

    div1 = document.createElement('div');
    div1.setAttribute("class", "form-outline m-1 row");

    inDiv1 = document.createElement('div');
    inDiv1.setAttribute("class", "m-1 p-1 col-5");

    inDiv2 = document.createElement('div');
    inDiv2.setAttribute("class", "m-1 p-1 col-2");

    form = document.createElement('form');
    form.setAttribute("class","p-4 ml-1 border-0 list-group-item");
    form.setAttribute("method","post");
    form.setAttribute("action","/book/{{$book['0']['id']}}");

    oForm = document.getElementById("original");
    iValue= oForm.firstElementChild.getAttribute("value");

    inpH = document.createElement("input");
    inpH.setAttribute("type", "hidden");
    inpH.setAttribute("name", "_token");
    inpH.setAttribute("value", iValue);

    lab = document.createElement('label');
    lab.setAttribute("class", "form-label");
    lab.setAttribute("for", "title");
    lab.innerHTML="Titulo: ";

    inp = document.createElement('input');
    inp.setAttribute("type", "text");
    inp.setAttribute("name", "title");
    inp.setAttribute("class", "form-control");
    inp.setAttribute("value", title);

    div2 = document.createElement('div');
    div2.setAttribute("class", "form-outline");

    lab2 = document.createElement('label');
    lab2.setAttribute("class", "form-label");
    lab2.setAttribute("for", "comment");
    lab2.innerHTML="Comentario: ";

    inp2 = document.createElement('textarea');
    inp2.setAttribute("rows", "5");
    inp2.setAttribute("cols", "100");
    inp2.setAttribute("name", "comment");
    inp2.setAttribute("class", "form-control");
    inp2.innerHTML= comment;

    lab3 = document.createElement('label');
    lab3.setAttribute("class", "form-label");
    lab3.setAttribute("for", "rate");
    lab3.innerHTML="Valoración:";

    inp3 = document.createElement('input');
    inp3.setAttribute("type", "number");
    inp3.setAttribute("min", "0");
    inp3.setAttribute("max", "10");
    inp3.setAttribute("name", "rate");
    inp3.setAttribute("class", "form-control");
    inp3.setAttribute("value", rate);

    but = document.createElement('button');
    but.setAttribute("type", "sumbit");
    but.setAttribute("name", "save");
    but.setAttribute("class", "btn btn-success btn-block mb-4 col-3");
    but.innerHTML="Guardar comentario";


    inDiv1.appendChild(lab);
    inDiv1.appendChild(inp);

    inDiv2.appendChild(lab3);
    inDiv2.appendChild(inp3);

    div1.appendChild(inDiv1);
    div1.appendChild(inDiv2);

    div2.appendChild(lab2);
    div2.appendChild(inp2);

    form.appendChild(inpH);
    form.appendChild(div1);
    form.appendChild(div2);
    form.appendChild(but);

    div.appendChild(form).scrollIntoView();

}

}
    
function update_coment(userid, username, rate, title, comment) {
let admin = false;

<?php
if($admin){
    echo "admin=true;";
}
?>

    let div= document.getElementById(username);
    while (div.firstChild) {
        div.removeChild(div.firstChild);
    }

    div1 = document.createElement('div');
    div1.setAttribute("class", "form-outline m-1 row");

    inDiv1 = document.createElement('div');
    inDiv1.setAttribute("class", "m-1 p-1 col-5");

    inDiv2 = document.createElement('div');
    inDiv2.setAttribute("class", "m-1 p-1 col-2");

    form = document.createElement('form');
    form.setAttribute("class","p-4 ml-1 border-0 list-group-item");
    form.setAttribute("method","post");
    form.setAttribute("action","/book/{{$book['0']['id']}}");

    oForm = document.getElementById("original");
    iValue= oForm.firstElementChild.getAttribute("value");

    inpH = document.createElement("input");
    inpH.setAttribute("type", "hidden");
    inpH.setAttribute("name", "_token");
    inpH.setAttribute("value", iValue);

    lab = document.createElement('label');
    lab.setAttribute("class", "form-label");
    lab.setAttribute("for", "title");
    lab.innerHTML="Titulo: ";

    inp = document.createElement('input');
    inp.setAttribute("type", "text");
    inp.setAttribute("name", "title");
    inp.setAttribute("class", "form-control");
    inp.setAttribute("value", title);

    div2 = document.createElement('div');
    div2.setAttribute("class", "form-outline");

    lab2 = document.createElement('label');
    lab2.setAttribute("class", "form-label");
    lab2.setAttribute("for", "comment");
    lab2.innerHTML="Comentario: ";

    inp2 = document.createElement('textarea');
    inp2.setAttribute("rows", "5");
    inp2.setAttribute("cols", "100");
    inp2.setAttribute("name", "comment");
    inp2.setAttribute("class", "form-control");
    inp2.innerHTML= comment;

    lab3 = document.createElement('label');
    lab3.setAttribute("class", "form-label");
    lab3.setAttribute("for", "rate");
    lab3.innerHTML="Valoración:";

    inp3 = document.createElement('input');
    inp3.setAttribute("type", "number");
    inp3.setAttribute("min", "0");
    inp3.setAttribute("max", "10");
    inp3.setAttribute("name", "rate");
    inp3.setAttribute("class", "form-control");
    inp3.setAttribute("value", rate);

    but = document.createElement('button');
    but.setAttribute("type", "sumbit");
    but.setAttribute("name", "save");
    but.setAttribute("class", "btn btn-success btn-block mb-4 col-3");
    but.innerHTML="Guardar comentario";

    if(admin){
        inpA = document.createElement("input");
        inpA.setAttribute("type", "hidden");
        inpA.setAttribute("name", "userid");
        inpA.setAttribute("value", userid);
    }


    inDiv1.appendChild(lab);
    inDiv1.appendChild(inp);

    inDiv2.appendChild(lab3);
    inDiv2.appendChild(inp3);

    div1.appendChild(inDiv1);
    div1.appendChild(inDiv2);

    div2.appendChild(lab2);
    div2.appendChild(inp2);

    form.appendChild(inpH);
        if(admin){
        form.appendChild(inpA);
    }
    form.appendChild(div1);
    form.appendChild(div2);
    form.appendChild(but);


    div.appendChild(form).scrollIntoView();



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
        <div class="col-2 align-self-center">
        <span class="badge bg-primary "> Puntuación: '.$userData[$i]["rate"].' </span>
        </div>
        ';

        echo '
        <div class="col-3 align-self-end">
        <strong>Fecha publicación: </strong> <span class="amount-old">'.$userData[$i]["date_review"].'</span>
        </div>';
        if(isset($_SESSION["user_id"])){

            if($_SESSION['user_id'] == $userData[$i]['user_id'] ||  $admin ){
            echo '<div class="col-1 align-self-center">
            <button type="button" class="btn btn-default btn-sm" onclick="update_coment('.$userData[$i]["user_id"].','."'".$userData[$i]["username"]."'".', '.$userData[$i]["rate"].', '."'".$userData[$i]["title_review"]."'".', '."'".$userData[$i]["review"]."'".')">
            <span class="glyphicon glyphicon-edit"></span> Editar
            </button></div>';
            }
        }
        

        echo '</div>


        <div id="'.$userData[$i]["username"].'" class="col-12">
        
        <div class="m-1 p-1"> <strong> '.$userData[$i]["title_review"].' </strong> </div><br/>
            <p>
            '.$userData[$i]["review"].'
            </p>

        </div>


        </div>    </div>';
}
?>


@endsection
