@extends('layout')

@section('title', 'Detalle Autor')

@section('content')
    <div class="row">
        <?php
        echo '<div class="m-4 p-2 shadow rounded border-bottom container border-top d-flex col-md-12 flex-shrink-0">
                            <div class="container">
                            <div class="row justify-content-start">
                            <div class="col-3 portada ">
                            <a href="#"><img src="data:image/jpeg;base64,' .
            base64_encode($author['0']['photo']) .
            '" width="150" height="200" alt="portada"></a>
                            </div>

                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li>Nombre: ' .
            $author['0']['author_name'] .
            '  </li>
                                    <li>Año nacimiento:' .
            $author['0']['birth_date'] .
            '</li>
                                    <li>Año muerte:' .
            $author['0']['death_date'] .
            '</li>
                                    <li>Pais: <a href="/countryauthor/' . $author['0']['country']['id'] . '" style="text-decoration:none" class="link-dark">' .
            $author['0']['country']['country_name'] .
            '</a></li>
                                    <li>Descripción: ' .
            $author['0']['description'] .
            '</li>
                                </ul>
                            </div>

                            <div class="col-3 ratings text-center align-bottom border-start">

                            <span class="badge bg-primary"> Puntuación: ';
        $nrate = count($author['0']['accounts']);
        $rate = 0;
        for ($i = 0; $i < $nrate; $i++) {
            $rate += $author['0']['accounts'][$i]['pivot']['rate'];
        }
        $avgrate = $nrate > 0 ? round($rate / $nrate, 2) : 0;
        echo $avgrate .
            '</span>
                             <span class="badge bg-primary"> Votos: ' .
            count($author['0']['accounts']) .
            '</span>
                            <span class="badge bg-primary"> Libros: ' .
            count($author['0']['books']) .
            '</span>
                            </div>
                            </div>
                            </div>
                            </div>';

        ?>
    </div>


    <div class="row">

        <?php

        $admin = true;

        foreach ($author['0']['books'] as $book) {
            $year = date('Y', strtotime($book->publi_date));
        echo '<div class="m-4 p-2 shadow rounded border-bottom container border-top d-flex col-md-12 flex-shrink-0">
        <div class="container">
        <div class="row justify-content-start">
        <div class="col-3 portada ">
        <a href="/book/' . $book->id . '"><img src="data:image/jpeg;base64,' . base64_encode($book->cover) . '" width="150" height="200" alt="portada"></a>
        </div>

        <div class="col-6">
        <ul class="list-unstyled">
        <li>Titulo: <a href="/book/' . $book->id . '" style="text-decoration:none" class="link-dark">' . $book->title .'</a></li>';
        $nauth = count($book->authors);
        if ($nauth > 1 ) {
            echo '<li>Autor:';
            for ($i = 0; $i < $nauth; $i++) {
                echo '<a href="/author/' . $book->authors[$i]['id'] . '"  style="text-decoration:none" class="link-dark"> ' . $book->authors[$i]['author_name'] . ' </a>';
                if ($nauth > 1 && $i < $nauth - 1) {
                    echo 'y';
                }
            }
            echo '</li>';
        }

        echo ' <li>Año: <a href="#" style="text-decoration:none" class="link-dark">' .
            $year .
            '</a></li>
        <li>Pais: <a href="/countrybook/' . $book->country['id'] . '" style="text-decoration:none" class="link-dark">' . $book->country['country_name'] . '</a></li>

        <li>Generos:';
        $ngen = count($book->genres);
        for ($i = 0; $i < $ngen; $i++) {
            echo '<a href="/genre/' . $book->genres[$i]['id'] . '" style="text-decoration:none" class="link-info"> ' . $book->genres[$i]['genre_name'] . '</a>';
            if ($ngen > 1 && $i < $ngen - 1) {
                echo ',';
            }
        }

        echo '</li>

        </ul>
        </div>

        <div class="col-3 ratings text-center align-bottom border-start">
        <span class="badge bg-primary"> Puntuación: ';
        $nrate = count($book->accounts);
        $rate = 0;
        for ($i = 0; $i < $nrate; $i++) {
            $rate += $book->accounts[$i]['pivot']['rate'];
        }
        $avgrate = $nrate > 0 ? round($rate / $nrate, 2) : 0;
        echo $avgrate .
        '</span>
        <span class="badge bg-primary"> Votos: ' .
            count($book->accounts) .
            '</span>

        </div>
        </div>
        </div>
        </div>';
        }

        ?>

    </div>

@endsection
