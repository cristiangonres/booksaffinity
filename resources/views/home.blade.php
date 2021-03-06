@extends('layout')

@section('title', 'BooksAffinity')

@section('content')

<style>
    #form {
  width: 250px;
  margin: 0 auto;
  height: 50px;
}

#form p {
  text-align: center;
}

#form label {
  font-size: 20px;
}

input[type="radio"] {
  display: none;
}

label {
  color: grey;
}

.clasificacion {
  direction: rtl;
  unicode-bidi: bidi-override;
}

label:hover,
label:hover ~ label {
  color: orange;
}

input[type="radio"]:checked ~ label {
  color: orange;
}
</style>

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

    <div class="row">
        <div class="mt-4 ml-4">
            {!! $data->links() !!}
        </div>
        @if(!empty($data) && $data->count())
                @foreach($data as $key => $book)
                <?php


                $year = date('Y', strtotime($book->publi_date));
                echo '<div class="m-4 p-2 shadow rounded border-bottom container border-top d-flex col-md-12 flex-shrink-0">
                <div class="container">
                <div class="row justify-content-start">
                <div class="col-2 portada ">
                <a href="/book/' . $book->id . '"><img src="data:image/jpeg;base64,' . base64_encode($book->cover) . '" width="150" height="200" alt="portada"></a>
                </div>

                <div class="col-6">
                <ul class="list-unstyled">
                <li class="h4">Titulo: <strong><a href="/book/' . $book->id . '"  class="link-dark">' . $book->title .'</a></strong></li>
                <li>Autor:';
                $nauth = count($book->authors);
                for ($i = 0; $i < $nauth; $i++) {
                    echo '<a href="/author/' . $book->authors[$i]['id'] . '"  class="link-dark"> ' . $book->authors[$i]['author_name'] . ' </a>';
                    if ($nauth > 1 && $i < $nauth - 1) {
                        echo 'y';
                    }
                }
                echo '</li>

                <li>A??o: <a href="/booksbyyear/'.$year.'"  class="link-dark">' .
                    $year .
                    '</a></li>
                <li>Pais: <a href="/countrybook/' . $book->country['id'] . '"  class="link-dark">' . $book->country['country_name'] . '</a></li>

                <li>Generos:';
                $ngen = count($book->genres);
                for ($i = 0; $i < $ngen; $i++) {
                    echo '<a href="/genre/' . $book->genres[$i]['id'] . '" class="link-info"> ' . $book->genres[$i]['genre_name'] . '</a>';
                    if ($ngen > 1 && $i < $ngen - 1) {
                        echo ',';
                    }
                }

                echo '</li>

                </ul>
                </div>';

                echo '<div class="col-2 ratings d-flex align-items-center flex-column border-start">
                <br>
                <form>

                <p class="clasificacion">
                <span class="badge bg-primary"> Puntuaci??n: ';
                echo $book->score + 1;
                $halfAverage = round($book->score/2, 0);
                $star5="";$star4="";$star3="";$star2="";$star1="";

                switch($halfAverage){
                    case 1:
                        $star1="checked";
                        break;

                    case 2:
                        $star2="checked";
                        break;

                    case 3:
                        $star3="checked";
                        break;

                    case 4:
                        $star4="checked";
                        break;

                    case 5:
                        $star5="checked";
                        break;

                    default:
                        break;

                }

                echo
                '</span><br>
                    <input id="radio1" type="radio" name="estrellas" value="5" '.$star5.' ><!--
                    --><label for="radio1">???</label><!--
                    --><input id="radio2" type="radio" name="estrellas" value="4" '.$star4.'><!--
                    --><label for="radio2">???</label><!--
                    --><input id="radio3" type="radio" name="estrellas" value="3" '.$star3.'><!--
                    --><label for="radio3">???</label><!--
                    --><input id="radio4" type="radio" name="estrellas" value="2" '.$star2.'><!--
                    --><label for="radio4">???</label><!--
                    --><input id="radio5" type="radio" name="estrellas" value="1" '.$star1.'><!--
                    --><label for="radio5">???</label>

                </p>

                </form>
                <br>
                <span class="badge bg-primary"> Votos: ' .
                    count($book->accounts) .
                '</span>

                </div>';


                if($admin){
                    echo '<div class="col-1 buttons border-start"';
                    echo'
                    <li><a href="/bookmanage/'.$book->id.'" style="text-decoration:none" class="link-dark">
                    <button type="button" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-edit"></span> Edit
                    </button>
                    </a></li>
                    </div>';


                }

                echo'
                </div>
                </div>
                </div>';

                ?>
                @endforeach
            @else
                <tr>
                    <td colspan="10">There are no data.</td>
                </tr>
            @endif


    {!! $data->links() !!}



    </div>

@endsection
