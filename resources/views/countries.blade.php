@extends('layout')

@section('title', 'Categorías')

@section('content')
<div class="row">
    <?php


        foreach($countries as $country){
            echo '<ul class="list-group">
                    <li class="list-group-item"><a href=/country/' . $country->id . '>' . $country->country_name     . '</a></li>
                </ul>';
        }
    ?>
</div>

@endsection
