@extends('layout')

@section('title', 'Sign Up')

@section('content')

<h2>CREAR NUEVO USUARIO</h2>

<form class="form_Login" action="/afterSignup" method="POST">
    @csrf
    <p>Nombre: <input type="text" required name="name"/></p>
    <P>Apellido: <input type="text" required name="surNameUser"/></P>
    <P>Segundo apellido: <input type="text" required name="lastNameUser"/></P>
    <P>Fecha nacimiento: <input type="date" required name="dateUser"/></P>
    <p>email: <input type="email" required name="emailUser"/></p>
    <p>Nombre de usuario: <input type="text" required name="userName"/></p>
    <p>Contraseña: <input type="password" required name="userPass"/></p>
    <p>Descripción: <input type="text" required name="description"/></p>
    <p><input type="submit" value="signUp"/></p>
</form>

@endsection