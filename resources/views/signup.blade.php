@extends('layout')

@section('title', 'Sign Up')

@section('content')

<form style='color: #f0d3f5; background-color: #6269a7' class="p-5 ml-1" action="/signup" method="post">
<h1>Alta usuario</h1><br>
@csrf
  <!-- 2 column grid layout with text inputs for the first and last names -->
  <div class="row mb-2">
    <div class="col-2">
      <div class="form-outline">
      <label class="form-label" for="form6Example1">Id</label>
        <input type="text" name="user_id" class="form-control" value= "" />
      </div>
    </div>
    <div class="col-2">
      <div class="form-outline">
      <label class="form-label" for="form6Example2">Nombre</label>
        <input type="text" name="username" class="form-control" value= "" />
      </div>
    </div>
  </div>

  <!-- 2 column grid layout with text inputs for the first and last names -->
  <div class="row mb-4">
    <div class="col-2">
      <div class="form-outline">
      <label class="form-label" for="form6Example3">Password</label>
        <input type="password" name="user_password" class="form-control" value= "" />
      </div>
    </div>
    <div class="col-2">
      <div class="form-outline">
      <label class="form-label" for="form6Example4">Email</label>
        <input type="email" name="email" class="form-control" value= "" />
      </div>
    </div>
  </div>

  <div class="form-outline mb-4 col-4">
    <label class="form-label" for="form6Example7">Descripcion</label>
    <textarea class="form-control" name="description" rows="4"></textarea>
  </div>


  <!-- Submit button -->
  <button type="submit" name="save" class="btn btn-success btn-block mb-4">Guardar</button>
  <button type="submit" name="cancel" class="btn btn-danger btn-block mb-4">Cancelar</button>
</form>



@endsection