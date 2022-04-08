@extends('layout')

@section('title', 'Categorías')

@section('content')
<div class="row">
    <?php

        foreach($genres as $genre){
            echo '<ul class="list-group">
                    <li class="list-group-item"><a href=/genre/' . $genre->id . '>' . $genre->genre_name . '</a></li>
                </ul>';
        }

    ?>
</div>

@endsection
