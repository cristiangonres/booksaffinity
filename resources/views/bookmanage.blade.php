@extends('layout')

@section('title', 'Manage Books')

@section('content')


<form class="p-5 ml-1 " action="/bookmanage" method="post" enctype="multipart/form-data">
@csrf
<?php
if(!isset($book)){
  $book["0"]["title"]="";
  $book["0"]["synopsis"]="";
  $book["0"]["pages"]="";
  $book["0"]["publi_date"]="";
  echo "<h2>Subir nuevo libro</h2><br>";
}else{
  echo "<h2>Editando libro ".$book["0"]["title"]." - (Id: ".$book["0"]["id"].")</h2><br>";
  echo '<input type="hidden" name="id" value= "'.$book["0"]["id"].'"/>';
}
?>
  <!-- 2 column grid layout with text inputs for the first and last names -->
  <div class="row col-12 mb-2">
    <div class="col-4">
      <div class="form-outline">
      <label class="form-label" for="title">Titulo: </label>
        <input type="text" name="title" class="form-control" value= '{{$book["0"]["title"]}}' />
      </div>
    </div>
    <div class="col-2">
      <div class="form-outline">
      <label class="form-label" for="pages">Paginas:</label>
        <input type="number" name="pages" class="form-control" value= '{{$book["0"]["pages"]}}' />
      </div>
      </div>
      </div>

    <div class="row col-12 mb-2">
    <div class="col-4">
    <div class="form-outline">
      <label class="form-label" for="pubDate">Fecha de publicacion:</label>
        <input type="date" name="pubDate" class="form-control" value= '{{$book["0"]["publi_date"]}}' />
      </div>
      </div>
      <div class="col-4">
      <div class="form-outline">
      <label class="form-label" for="country">Pais:</label>
        <select name="country" class="form-control">
            <?php
            foreach ($countries as $country){
              if(isset($book["0"]["country_id"])){
                if($book["0"]["country_id"]==$country->id){
                  echo '<option value="'.$country->id.'" selected>'.$country->country_name.'</option>';
                }else{
                echo '<option value="'.$country->id.'">'.$country->country_name.'</option>';
                }
              }else{
                echo '<option value="'.$country->id.'">'.$country->country_name.'</option>';
                }
                
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
      <?php
      $nauth=0;
      if(isset($book["0"]["authors"])){
        $nauth = count($book["0"]["authors"]);
        for ($i = 0; $i < $nauth; $i++) {
            echo '<input type="text" name="author'.$i.'" class="form-control" value="'.$book["0"]["authors"][$i]["author_name"].'" />';
        }
      }else{
        echo '<input type="text" name="author1" class="form-control" />';
      }

      ?>
      </div>
      <a href="javascript:author_new()">A??adir autor </a>
      </div>
    <div id="ins" class="col-4">
      <div class="form-outline">
      <label class="form-label" for="genre1">Genero: </label>
      

        <?php
        $ngen =0;
        if(isset($book["0"]["genres"])){
          $ngen = count($book["0"]["genres"]);
          for ($i = 0; $i < $ngen; $i++) {
            echo '<select name="genre'.$i.'" class="form-control">';
            foreach ($genres as $genre){
              if($book["0"]["genres"][$i]['id']==$genre->id){
                echo '<option value="'.$genre->id.'" selected>'.$genre->genre_name.'</option>';
              }else{
                echo '<option value="'.$genre->id.'">'.$genre->genre_name.'</option>';
              }
              
          }
          echo '</select>';
          }
          
        }else{
          echo '<select name="genre1" class="form-control">';
          foreach ($genres as $genre){
                echo '<option value="'.$genre->id.'">'.$genre->genre_name.'</option>';
            }
            echo '</select>';
        }
        ?>
            <?php
            

            ?>
        </select>
      </div>
      <a href="javascript:genre_new()">A??adir g??nero </a>
    </div>

      </div>


    <div class="row col-12 mb-2">
  <div class="form-outline mb-4 col-6">
    <label class="form-label" for="synopsis">Sinopsis:</label>
    <textarea class="form-control" name="synopsis" rows="4">{{$book["0"]["synopsis"]}}</textarea>
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
<?php
echo 'var c='.($nauth+1).';';

?>


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

<?php
echo 'var d='.($ngen+1).';';

?>

function genre_new(){
    d++;

    div1 = document.createElement('div');
    div1.setAttribute("class", "form-outline");

    lab = document.createElement('label');
    lab.setAttribute("class", "form-label");
    lab.setAttribute("for", "genre"+d);
    lab.innerHTML="G??nero: ";

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


@endsection

@section('js')


@endsection
