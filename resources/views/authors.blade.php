@extends('layout')

@section('title', 'Authors')

@section('content')



<div class="row">
    <?php

    $admin = true;

    foreach ($authors as $author) {

        echo '<div class="m-4 p-2 shadow rounded border-bottom container border-top d-flex col-md-12 flex-shrink-0">
        <div class="container">
        <div class="row justify-content-start">
        <div class="col-3 portada ">
        <a href="/author/' . $author->id . '"><img src="data:image/jpeg;base64,' . base64_encode($author->photo) . '" width="150" height="200" alt="portada"></a>
        </div>

        <div class="col-6">
        <ul class="list-unstyled">
        <li>Nombre: <a href="/author/' . $author->id . '" style="text-decoration:none" class="link-dark">' . $author->author_name . '</a></li>
        <li>Año nacimiento:' . $author->birth_date .  '</li>
        <li>Año muerte:' .  $author->birth_date .  '</li>
        <li>Pais: <a href="#" style="text-decoration:none" class="link-dark">' .  $author->country['country_name'] . '</a></li>
        </ul>
        </div>

        <div class="col-3 ratings text-center align-bottom border-start">
        <span class="badge bg-primary"> Puntuación: ';
        $nrate = count($author->accounts);
        $rate = 0;
        for ($i = 0; $i < $nrate; $i++) {
            $rate += $author->accounts[$i]['pivot']['rate'];
        }
        $avgrate = $nrate > 0 ? round($rate / $nrate, 2) : 0;
        echo $avgrate .
        '</span>
        <span class="badge bg-primary"> Votos: ' .
            count($author->accounts) .
            '</span>

        </div>
        </div>
        </div>
        </div>';
    }

    ?>

</div>




@endsection
