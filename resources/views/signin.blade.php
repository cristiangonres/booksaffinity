@extends('layout')

@section('title', 'Sign Up')

@section('content')

<h2>Registrarse</h2>

<form class="form_Login" action="/afterSignin" method="POST">
    @csrf
    <p>Nombre de usuario: <input type="text" name="userName"/></p>
    <p>Contraseña: <input type="password" name="userPass"/></p>
    <p><input type="submit" value="signUp"/></p>
</form>

@endsection