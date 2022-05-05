@extends('layout')

@section('title', 'Sign Up')

@section('content')

<p>
    <?php 
        var_dump($name, $fecha , $countryID, $country, $desc);
        echo '</br>', $name, '</br>', $fecha, '</br>', $countryID, '</br>', $country, '</br>', $desc;
    ?> 
</p>

@endsection