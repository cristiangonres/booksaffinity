@extends('layout')

@section('title', 'Categorías')

@section('content')
<div class="row">
    <?php 
        //var_dump($categories);
        
        foreach($categories as $category){
            echo '<ul class="list-group">
                    <li class="list-group-item"><a href=/category/' . $category->id . '>' . $category->genre_name . '</a></li>
                </ul>';
            //echo $category->genre_name;
        }

    ?> 
</div>

@endsection