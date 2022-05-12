@extends('layout')


@section('title', 'User Panel')

@section('content')




    <form id="original" class="p-5 ml-1 list-group-item" action="/userPanel" method="post">

    @csrf
    <div class="row col-12 mb-2">
        <div class="col-4">
            <div class="form-outline">
                    <?php
                        echo '<input type="text" name="userID" class="form-control" value="' . $userDB[0]["id"] . '" required hidden/>';
                    ?>                    
                </div>
        </div>
    </div>
    <div class="row col-12 mb-2">
        <div class="col-4">
            <div class="form-outline">
                <h3>Perfil de <?php echo $userDB[0]['username'];?> </h3>
            </div>
        </div>
    </div>

    <div class="row col-12 mb-2">
        <div class="col-6">
            <div class="form-outline">
                <label class="form-label" for="form6Example2">Descripción: </label>
                <textarea rows="2" cols="40" name="userDesc" class="form-control"><?php echo $userDB[0]['description'];?></textarea> 
                <button type="submit" name="button" value="update" class="btn btn-success btn-block mt-3 mb-4">Actualizar</button>                   
            </div>
        </div>
        <div class="col-5">
            <div class="form-outline">
                <label class="form-label" for="form6Example2">Introduzca contraseña actual: </label>
                <input type="text" name="userOldPass" class="form-control" value=""/>
                       
                <label class="form-label" for="form6Example2">Introduzca contraseña nueva: </label>
                <input type="text" name="userNewPass" class="form-control" value=""/>
                <button type="submit" name="button" value="changePass" class="btn btn-success btn-block mb-4">Cambiar contraseña</button>
                <button type="submit" name="button" value="delete" class="btn btn-danger btn-block mb-4">Eliminar cuenta</button>
                              
            </div>
        </div>

    </div>

</form>

<script>
function edit_comment(book_title, bookid, title, rate, comment) {



    let div= document.getElementById(book_title);
    while (div.firstChild) {
        div.removeChild(div.firstChild);
    }

    div1 = document.createElement('div');
    div1.setAttribute("class", "form-outline m-1 row");

    inDiv1 = document.createElement('div');
    inDiv1.setAttribute("class", "m-1 p-1 col-5");

    inDiv2 = document.createElement('div');
    inDiv2.setAttribute("class", "m-1 p-1 col-2");

    form = document.createElement('form');
    form.setAttribute("class","p-4 ml-1 border-0 list-group-item");
    form.setAttribute("method","post");
    form.setAttribute("action","/userPanel/"+bookid);

    oForm = document.getElementById("original");
    iValue= oForm.firstElementChild.getAttribute("value");

    inpH = document.createElement("input");
    inpH.setAttribute("type", "hidden");
    inpH.setAttribute("name", "_token");
    inpH.setAttribute("value", iValue);

    lab = document.createElement('label');
    lab.setAttribute("class", "form-label");
    lab.setAttribute("for", "title");
    lab.innerHTML="Titulo: ";

    inp = document.createElement('input');
    inp.setAttribute("type", "text");
    inp.setAttribute("name", "title");
    inp.setAttribute("class", "form-control");
    inp.setAttribute("value", title);

    div2 = document.createElement('div');
    div2.setAttribute("class", "form-outline");

    lab2 = document.createElement('label');
    lab2.setAttribute("class", "form-label");
    lab2.setAttribute("for", "comment");
    lab2.innerHTML="Comentario: ";

    inp2 = document.createElement('textarea');
    inp2.setAttribute("rows", "5");
    inp2.setAttribute("cols", "100");
    inp2.setAttribute("name", "comment");
    inp2.setAttribute("class", "form-control");
    inp2.innerHTML= comment;

    lab3 = document.createElement('label');
    lab3.setAttribute("class", "form-label");
    lab3.setAttribute("for", "rate");
    lab3.innerHTML="Valoración:";

    inp3 = document.createElement('input');
    inp3.setAttribute("type", "number");
    inp3.setAttribute("min", "0");
    inp3.setAttribute("max", "10");
    inp3.setAttribute("name", "rate");
    inp3.setAttribute("class", "form-control");
    inp3.setAttribute("value", rate);

    but = document.createElement('button');
    but.setAttribute("type", "sumbit");
    but.setAttribute("name", "save");
    but.setAttribute("class", "btn btn-success btn-block mb-4 col-3");
    but.innerHTML="Guardar comentario";


    inDiv1.appendChild(lab);
    inDiv1.appendChild(inp);

    inDiv2.appendChild(lab3);
    inDiv2.appendChild(inp3);

    div1.appendChild(inDiv1);
    div1.appendChild(inDiv2);

    div2.appendChild(lab2);
    div2.appendChild(inp2);

    form.appendChild(inpH);
    form.appendChild(div1);
    form.appendChild(div2);
    form.appendChild(but);

    div.appendChild(form).scrollIntoView();





}


</script>


<?php
if(isset($userData)){
$n = count($userData);

for ($i = 0; $i < $n; $i++) {

echo '<div class="m-4 p-2 shadow rounded border-bottom container border-top d-flex col-md-12 flex-shrink-0">
    <div class="row m-0">
        <div class="row m-1 border-bottom">
        <div class="col-1 m-1 p-3">
        <img src="../img/random-user.jpg" width="65" height="65" alt="user-img">

        </div>

        <div class="m-bot15 col-4 align-self-center ">
            <strong>Libro:</strong><span class="amount-old"> '.$userData[$i]["book_title"].' </span>
            <div class="m-bot15">
                <strong>Valoraciones: </strong> <span class="amount-old"> '.$userData[$i]["score"].' </span>
                <strong>Opiniones: </strong> <span class="amount-old"> '.$userData[$i]["comments"].' </span>
            </div>

        </div>
        <div class="col-2 align-self-center">
        <span class="badge bg-primary "> Puntuación: '.$userData[$i]["rate"].' </span>
        </div>
        ';

        echo '
        <div class="col-3 align-self-end">
        <strong>Fecha publicación: </strong> <span class="amount-old">'.$userData[$i]["date_review"].'</span>
        </div>';

        
        echo '<div class="col-1 align-self-center">
        <button type="button" class="btn btn-default btn-sm" onclick='."'".'edit_comment("'.$userData[$i]["book_title"].'", "'.$userData[$i]["book_id"].'", "'.$userData[$i]["title_review"].'", '.$userData[$i]["rate"].', "'.$userData[$i]["review"].'"'.')'."'".'>
        <span class="glyphicon glyphicon-edit"></span> Editar
        </button></div>';
        


        echo '</div>


        <div id="'.$userData[$i]["book_title"].'" class="col-12">
        
        <div class="m-1 p-1"> <strong> '.$userData[$i]["title_review"].' </strong> </div><br/>
            <p>
            '.$userData[$i]["review"].'
            </p>

        </div>


        </div>    </div>';
}
}
?>



@endsection
