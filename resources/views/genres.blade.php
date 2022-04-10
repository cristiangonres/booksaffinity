@extends('layout')

@section('title', 'Categorías')

@section('content')
<div class="row">
    <ul class="list-group">
    <?php

        foreach($genres as $genre){
            echo '<li class="list-group-item"><a href=/genre/' . $genre->id . '>' . $genre->genre_name . '</a></li>';
        }

    ?>
    </ul>
</div>

@endsection
