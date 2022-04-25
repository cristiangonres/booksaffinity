@extends('layout')

@section('title', 'Detalle Autor')

@section('content')
    <div class="row">
        <form class="p-5 ml-1 list-group-item" action="/afterSubmitAuthor" method="post">
            <h2>Insertar autor.</h2><br>
            @csrf
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row col-12 mb-2">
                <div class="col-8">
                    <div class="form-outline">
                        <label class="form-label" for="cover">Portada:</label>
                        <input type="file" name="autorCover" class="form-control" value= ""/>
                    </div>
                </div>
            </div>

            <div class="row col-12 mb-2">
                <div class="col-4">
                <div class="form-outline">
                <label class="form-label" for="form6Example2">Nombre autor: </label>
                    <input type="text" name="autorName" class="form-control" value="" required/>
                </div>
                </div>
            </div>

            <div class="row col-12 mb-2">
                <div class="col-4">
                <div class="form-outline">
                <label class="form-label" for="userPass">Año nacimiento:</label>
                    <input type="date" name="autorBirthdate" class="form-control" value="" required/>
                </div>
                </div>
            </div>

            <div class="row col-12 mb-2">
                <div class="col-4">
                <div class="form-outline">
                <label class="form-label" for="userPass">Año muerte (no poner nada si está vivo):</label>
                    <input type="date" name="autorDeathdate" class="form-control" value=""/>
                </div>
                </div>
            </div>

            <div class="row col-12 mb-2">
                <div class="col-4">
                <div class="form-outline">
                <label class="form-label" for="userPass">País:</label>
                    <input type="text" name="autorCountry" class="form-control" value="" required/>
                </div>
                </div>
            </div>           

            <div class="form-outline mb-4 col-6">
                <label class="form-label" for="description">Descripción:</label>
                <textarea class="form-control" name="autorDescription" rows="4" cols="50" required></textarea>
            </div>

            <!-- Submit button -->
            <div class="form-outline mb-4 col-4">
                <button type="submit" name="button" class="btn btn-success btn-block mb-4">Insertar</button>
            </div>
        </form>

    </div>

@endsection
