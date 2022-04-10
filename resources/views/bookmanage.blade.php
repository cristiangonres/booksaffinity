@extends('layout')

@section('title', 'Manage Books')

@section('content')


<form class="p-5 ml-1 list-group-item" action="/bookmanage" method="post" enctype="multipart/form-data">
<h1>Subir, editar y eliminar libros</h1><br>
@csrf
  <!-- 2 column grid layout with text inputs for the first and last names -->
  <div class="row col-12 mb-2">
    <div class="col-4">
      <div class="form-outline">
      <label class="form-label" for="title">Titulo: </label>
        <input type="text" name="title" class="form-control" value= "" />
      </div>
    </div>
    <div class="col-4">
      <div class="form-outline">
      <label class="form-label" for="author">Autor: </label>
        <input type="text" name="author" class="form-control" value= "" />
      </div>
      </div>
      </div>

    <div class="row col-12 mb-2">
    <div class="col-4">
    <div class="form-outline">
      <label class="form-label" for="pubDate">Fecha de publicacion:</label>
        <input type="date" name="pubDate" class="form-control" value= "" />
      </div>
      </div>
      <div class="col-4">
      <div class="form-outline">
      <label class="form-label" for="country">Pais:</label>
        <select name="country" class="form-control">
            <?php
            foreach ($countries as $country){
                echo '<option value="'.$country->id.'">'.$country->country_name.'</option>';
            }
            ?>
        </select>
      </div>
      </div>
    </div>


  <!-- 2 column grid layout with text inputs for the first and last names -->
  <div class="row col-12 mb-2">
    <div class="col-2">
      <div class="form-outline">
      <label class="form-label" for="pages">Paginas:</label>
        <input type="number" name="pages" class="form-control" value= "" />
      </div>
      </div>
      <div class="col-6">
      <div class="form-outline">
      <label class="form-label" for="cover">Portada:</label>
        <input type="file" name="cover" class="form-control" value= "" />
      </div>
      </div>
    </div>

    <div class="row col-12 mb-2">
      <div id="insert" class="col-4">
      <div id="addauthor" class="form-outline">
      <label class="form-label" for="author1">Autor: </label>
        <input type="text" name="author1" class="form-control" value= "" />
      </div>
      <a href="javascript:new_author()">Añadir autor </a>
      </div>
    <div class="col-4">
      <div class="form-outline">
      <label class="form-label" for="genre1">Genero: </label>
      <select name="genre1" class="form-control">
            <?php
            foreach ($genres as $genre){
                echo '<option value="'.$genre->id.'">'.$genre->genre_name.'</option>';
            }
            ?>
        </select>
      </div>
    </div>

      </div>

 
    <div class="row col-12 mb-2">
  <div class="form-outline mb-4 col-6">
    <label class="form-label" for="synopsis">Sinopsis:</label>
    <textarea class="form-control" name="synopsis" rows="4"></textarea>
  </div>
  </div>


  <!-- Submit button -->
  <div class="row col-12 mb-2">
  <div class="form-outline mb-4 col-4">
  <button type="submit" name="save" class="btn btn-success btn-block mb-4">Guardar Libro</button>
  <button type="submit" name="delete" class="btn btn-danger btn-block mb-4">Eliminar libro</button>
  </div>
 </div>
</form>

<style>
   #newlink {width:600px}
</style>
<form method="post" action="">
<div id="newlink">
<div>
<table>
	<tr>
		<td> Link URL: </td>
		<td> <input type="text" name="linkurl[]" value="http://www.satya-weblog.com"> </td>
	</tr>
	<tr>
		<td> Link Description: </td>
		<td>  <textarea name="linkdesc[]" cols="50" rows="5" ></textarea> </td>
	</tr>
</table>
</div>
</div>
	<p>
		<br>
		<input type="submit" name="submit1">
		<input type="reset" name="reset1">
	</p>
<p id="addnew">
	<a href="javascript:new_author()">Añadir autor </a>
</p>
</form>
<!-- Template -->
<div id="newlinktpl" style="display:none">
<div>
<table>
	<tr>
		<td> Link URL: </td>
		<td> <input type="text" name="linkurl[]" value=""> </td>
	</tr>
	<tr>
		<td> Link Description: </td>
		<td> <textarea name="linkdesc[]" cols="50" rows="5" ></textarea> </td>
	</tr>
</table>
</div>
</div>


 <script>
     /*

//This script is identical to the above JavaScript function.

var ct = 1;
function new_author()
{
	ct++;
	var div1 = document.createElement('div');
	div1.class = "form-outline";
	// link to delete extended form elements
	// var delLink = '<div style="text-align:right;margin-right:65px"><a href="javascript:delIt('+ ct +')">Del</a></div>';
	input= document.getElementById('addauthor');
    input.id="addauthor"+ct;

	document.getElementById('insert').appendChild(input);
}
// function to delete the newly added set of elements
function delIt(eleId)
{
	d = document;
	var ele = d.getElementById(eleId);
	var parentEle = d.getElementById('newlink');
	parentEle.removeChild(ele);
}*/
</script>

@endsection