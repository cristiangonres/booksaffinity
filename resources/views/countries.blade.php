@extends('layout')

@section('title', 'Categorías')

@section('content')
<div class="row">
<ul class="list-group">

    <?php


        foreach($countries as $country){
            echo '<li class="list-group-item"><a href=/countrybook/' . $country->id . '>' . $country->country_name     . '</a></li>';
        }
    ?>
</ul>
</div>

@endsection
