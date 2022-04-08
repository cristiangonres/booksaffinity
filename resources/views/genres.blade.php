@extends('layout')

@section('title', 'Categorías')

@section('content')
<div class="row">
    <?php
        //var_dump($categories);

        foreach($genres as $genre){
            echo '<ul class="list-group">
                    <li class="list-group-item"><a href=/genre/' . $genre->id . '>' . $genre->genre_name . '</a></li>
                </ul>';
            //echo $category->genre_name;
        }

    ?>
</div>

@endsection
