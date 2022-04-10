@extends('layout')

@section('title', 'Sign Up')

@section('content')

<!--<h2>CREAR NUEVO USUARIO</h2>

<form class="form_Login" action="/afterSignup" method="POST">
    @csrf
    <label class="form-label" for="userName">Nombre de usuario: </label> 
    <input type="text" required name="userName"/>
    <label class="form-label" for="emailUser">E-mail: </label> 
    <input type="email" required name="emailUser"/>
    <label class="form-label" for="userPass">Contraseña: </label> 
    <input type="password" required name="userPass"/>
    <label class="form-label" for="description">Descripción: </label> 
    <textarea type="text" required name="description"></textarea>
    <input type="submit" value="signUp"/>
</form>-->

<form class="p-5 ml-1 list-group-item" action="/afterSignup" method="post">
<h1>CREAR NUEVO USUARIO</h1><br>
@csrf
  <!-- 2 column grid layout with text inputs for the first and last names -->
  <div class="row col-12 mb-2">
    <div class="col-4">
      <div class="form-outline">
      <label class="form-label" for="form6Example2">Nombre de usuario: </label>
        <input type="text" name="userName" class="form-control" value= "" />
      </div>
    </div>

  </div>
  <div class="row col-12 mb-2">
    <div class="col-4">
      <div class="form-outline">
      <label class="form-label" for="userPass">Contraseña:</label>
        <input type="password" name="userPass" class="form-control" value= "" />
      </div>
      </div>
    </div>
  <!-- 2 column grid layout with text inputs for the first and last names -->
  <div class="row col-12 mb-4">

    <div class="col-4">
      <div class="form-outline">
      <label class="form-label" for="emailUser">Email:</label>
        <input type="email" name="emailUser" class="form-control" value= "" />
      </div>
    </div>
  </div>

  <div class="form-outline mb-4 col-6">
    <label class="form-label" for="description">Descripción:</label>
    <textarea class="form-control" name="description" rows="4"></textarea>
  </div>


  <!-- Submit button -->
  <div class="form-outline mb-4 col-4">
  <button type="submit" name="singUp" class="btn btn-success btn-block mb-4">Registrar</button>
  </div>

</form>

@endsection