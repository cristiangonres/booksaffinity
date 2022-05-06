@extends('layout')

@section('title', 'Sign Up')

@section('content')

<p>
    <?php 
        //var_dump($userName);
        echo $id, '<br>', $name, '<br>', $birthdate, '<br>', $birthDeath, '<br>', $imageContent, '<br>', 'ID País: ', $countryID, ' Nombre País: ', $country, '<br>', $description;
        //foreach($userNameDB as $username){
            //echo $username->username;
        //}
    ?> 
</p>

@endsection