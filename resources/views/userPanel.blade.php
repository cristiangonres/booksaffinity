@extends('layout')


@section('title', 'User Panel')

@section('content')



<?php
    echo 
    '
        <form class="p-5 ml-1 list-group-item" action="/afterEditUser/" method="post">
    ';    
?>
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
                <label class="form-label">User name:</label>
                <?php
                    echo '<label class="form-label">' . $userDB[0]['username'] . '</label>';
                ?> 
            </div>
        </div>
    </div>

    <div class="row col-12 mb-2">
        <div class="col-4">
            <div class="form-outline">
                <label class="form-label" for="form6Example2">Descripción: </label>
                <?php
                    echo '<input type="text" name="userDesc" class="form-control" value="' . $userDB[0]['description'] . '"/>';
                ?>                    
            </div>
        </div>
    </div>

    <div class="form-outline mb-4 col-4">
        <button type="submit" name="button" value="update" class="btn btn-success btn-block mb-4">Actualizar</button>
    </div>
    <div class="row col-12 mb-2">
        <div class="col-4">
            <div class="form-outline">
                <label class="form-label" for="form6Example2">Introduzca contraseña actual: </label>
                <?php
                    echo '<input type="text" name="userOldPass" class="form-control" value=""/>';
                ?>        
                <label class="form-label" for="form6Example2">Introduzca contraseña nueva: </label>
                <?php
                    echo '<input type="text" name="userNewPass" class="form-control" value=""/>';
                ?>               
            </div>
        </div>
    </div>

    <div class="form-outline mb-4 col-4">
        <button type="submit" name="button" value="changePass" class="btn btn-success btn-block mb-4">Cambiar contraseña</button>
        <button type="submit" name="button" value="delete" class="btn btn-danger btn-block mb-4">Eliminar cuenta</button>
    </div>

</form>




@endsection
