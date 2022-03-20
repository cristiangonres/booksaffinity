@extends('layout')

@section('title', 'BooksAffinity')

@section('content')

BLADE PARA HOME

<?php

      foreach($books as $book){
          echo $book->title . " - " . $book->publi_date . "<br>";
      }

?>



@endsection