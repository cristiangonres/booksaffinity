@extends('layout')

@section('title', 'Detalle Autor')

@section('content')
    <div class="row">
        <form class="p-5 ml-1 list-group-item" action="/afterEditEditorial" method="post" enctype="multipart/form-data">
            <h2>Editar o borrar editorial</h2><br>
            @csrf            
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="m-4 p-2 shadow rounded border-bottom container border-top d-flex col-md-12 flex-shrink-0">
                <h2>Un poco ñapa lo de poner un texto para advertir al administrador, pero total no es para todo el mundo esta vista...</h2>
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-3 portada ">
                            <?php
                                echo '<a href="#"><img src="data:image/jpeg;base64,' . base64_encode($editorial['0']['photo']) . '" width="150" height="200" alt="portada"></a>';
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-8">
                    <div class="form-outline">
                        <p class="text-danger">SI NO SE DESEA CAMBIAR LA IMAGEN AL ACTUALIZAR EL AUTOR NO INTRODUCIR NADA AQUÍ</p>
                        <label class="form-label" for="cover">Portada: </label>
                        <input type="file" name="editorialCover" class="form-control" value= "" />
                    </div>
                </div>
            </div>';

            <div class="row col-12 mb-2">
                <div class="col-4">
                    <div class="form-outline">                
                        <?php
                            echo '<input type="text" name="editorialID" class="form-control" value="' . $editorial['0']['id'] . '" required hidden/>';
                        ?>                    
                    </div>
                </div>
            </div>

            <div class="row col-12 mb-2">
                <div class="col-4">
                <div class="form-outline">
                <label class="form-label" for="form6Example2">Nombre: </label>
                    <?php
                        echo '<input type="text" name="editorialName" class="form-control" value="' . $editorial['0']['editorial_name'] . '" required/>';
                    ?>                    
                </div>
                </div>
            </div>

            <div class="row col-12 mb-2">
                <div class="col-4">
                    <div class="form-outline">
                        <label class="form-label" for="userPass">Año:</label>
                        <?php
                            echo '<input type="text" name="editorialDate" class="form-control" value="' . $editorial['0']['ini_date'] . '" required/>';
                        ?> 
                    </div>
                </div>
            </div>

            <div class="row col-12 mb-2">
                <div class="col-4">
                <div class="form-outline">
                <label class="form-label" for="userPass">País:</label>
                    <?php
                        echo '<input type="text" name="editorialCountry" class="form-control" value="' . $editorial['0']['country']['country_name'] . '" required/>';
                    ?> 
                </div>
                </div>
            </div>           

            <div class="form-outline mb-4 col-6">
                <label class="form-label" for="description">Descripción:</label>
                    <?php
                        echo '<textarea class="form-control" name="editorialDescription" rows="4" cols="50" required>' . $editorial['0']['description'] . '</textarea>';
                    ?> 
            </div>

            <!-- Submit button -->
            <div class="form-outline mb-4 col-4">
                <button type="submit" name="button" value="update" class="btn btn-warning btn-block mb-4">Actualizar</button>
                <button type="submit" name="button" value="delete" class="btn btn-danger btn-block mb-4">Borrar</button>
            </div>
        </form>

    </div>

@endsection
