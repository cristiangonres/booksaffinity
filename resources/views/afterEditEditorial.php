@extends('layout')

@section('title', 'Sign Up')

@section('content')

<p>
    <?php 
        var_dump($id, $name, $fecha , $countryID, $country, $desc);
        echo '</br>', $id, '</br>', $name, '</br>', $fecha, '</br>', $countryID, '</br>', $country, '</br>', $desc;
    ?> 
</p>

@endsection