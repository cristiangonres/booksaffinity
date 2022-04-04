@extends('layout')

@section('title', 'BooksAffinity')

@section('content')


    <div class="row">
        <?php

        $admin = true;

        foreach ($books as $book) {
            echo '<div class="m-4 p-2 shadow rounded border-bottom container border-top d-flex col-md-12 flex-shrink-0">

                  <div id="position">' .
                $book->id .
                '</div>
                  <div class="container">
                      <div class="row justify-content-start">
                          <div class="col-3 portada ">
                              <a href="#"><img src="data:image/jpeg;base64,' .
                base64_encode($book->cover) .
                '" width="150" height="200" alt="portada"></a>
                          </div>
                          <div class="col-6">
                              <ul class="list-unstyled">
                                  <li>Titulo: <a href="#" style="text-decoration:none" class="link-dark">' .
                $book->title .
                '</a></li>
                                  <li>Autor:';
            $nauth = count($book->authors);
            for ($i = 0; $i < $nauth; $i++) {
                echo '<a href="#" style="text-decoration:none" class="link-dark"> ' . $book->authors[$i]['author_name'] . ' </a>';
                if ($nauth > 1 && $i < $nauth - 1) {
                    echo 'y';
                }
            }
            echo '</li></li>
                                  <li>Fecha publicado: <a href="#" style="text-decoration:none" class="link-dark">' .
                $book->publi_date .
                '</a></li></li>
                                  <li>Pais: <a href="#" style="text-decoration:none" class="link-dark">' .
                $book->country['country_name'] .
                '</a></li></li>
                                  <li>Generos:';
            $ngen = count($book->genres);
            for ($i = 0; $i < $ngen; $i++) {
                echo '<a href="#" style="text-decoration:none" class="link-info"> ' . $book->genres[$i]['genre_name'] . ' </a>';
            }

            echo '</li>


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
