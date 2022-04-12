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
    <div class="col-2">
      <div class="form-outline">
      <label class="form-label" for="pages">Paginas:</label>
        <input type="number" name="pages" class="form-control" value= "" />
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

      <div class="col-8">
      <div class="form-outline">
      <label class="form-label" for="cover">Portada:</label>
        <input type="file" name="cover" class="form-control" value= "" />
      </div>
      </div>
    </div>

    <div class="row col-12 mb-2">
      <div id="insert" class="col-4">
      <div class="form-outline">
      <label class="form-label" for="author1">Autor: </label>
        <input type="text" name="author1" class="form-control" />
      </div>
      <a href="javascript:author_new()">Añadir autor </a>
      </div>
    <div id="ins" class="col-4">
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
      <a href="javascript:genre_new()">Añadir género </a>
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


 <script>
     

//This script is identical to the above JavaScript function.

var c=1;


function author_new(){
    c++;

    div1 = document.createElement('div');
    div1.setAttribute("class", "form-outline");

    lab = document.createElement('label');
    lab.setAttribute("class", "form-label");
    lab.setAttribute("for", "author"+c);
    lab.innerHTML="Autor: ";

    inp = document.createElement('input');
    inp.setAttribute("type", "text");
    inp.setAttribute("name", "author"+c);
    inp.setAttribute("class", "form-control");

    div1.appendChild(lab);
    div1.appendChild(inp);

    document.getElementById("insert").appendChild(div1);

}

var d=1;

function genre_new(){
    d++;

    div1 = document.createElement('div');
    div1.setAttribute("class", "form-outline");

    lab = document.createElement('label');
    lab.setAttribute("class", "form-label");
    lab.setAttribute("for", "genre"+d);
    lab.innerHTML="Género: ";

    sel = document.createElement('select');
    sel.setAttribute("type", "text");
    sel.setAttribute("name", "genre"+d);
    sel.setAttribute("class", "form-control");


    <?php
    $i=1;
    foreach ($genres as $genre){
        
    echo "opt".$i." =document.createElement('option');
    opt".$i.".setAttribute('value', ".$genre->id.");
    opt".$i.".innerHTML='".$genre->genre_name."';

    sel.appendChild(opt".$i.");";
    $i++;
    }
?>



    div1.appendChild(lab);
    div1.appendChild(sel);

    document.getElementById("ins").appendChild(div1);

}

// function to delete the newly added set of elements
/*function delIt(eleId)
{
	d = document;
	var ele = d.getElementById(eleId);
	var parentEle = d.getElementById('newlink');
	parentEle.removeChild(ele);
}*/
</script>

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


@endsection