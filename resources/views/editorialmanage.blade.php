@extends('layout')

@section('title', 'Manage Editorials')

@section('content')



<div class="row">
    <form method="get" action="/editorial/insertar">
        <button type="submit" value="insert" class="btn btn-primary">Insertar una nueva editorial</button>
    </form>

    <?php        
    //var_dump($editorial);
    foreach($data as $editorial){
        //echo $editorial;            

        $year = date('Y', strtotime($editorial->ini_date));

        echo '
        <div class="m-4 p-2 shadow rounded border-bottom container border-top d-flex col-md-12 flex-shrink-0">
            <div class="container">
                <div class="row justify-content-start">
                    <div class="col-3 portada ">
                      <a href="/author/' . $editorial->id . '"><img src="data:image/jpeg;base64,' . base64_encode($editorial->photo) . '" width="150" height="200" alt="portada"></a>
                    </div>
                    <div class="col-6">
                        <ul class="list-unstyled">
                            <li>Nombre: <a href="/editorial/' . $editorial->id . '" style="text-decoration:none" class="link-dark">' . $editorial->editorial_name .'</a></li>
                            <li>Año: <a href="#" style="text-decoration:none" class="link-dark">' . $year . '</a></li>
                            <li>Pais: <a href="/countrybook/' . $editorial->country['id'] . '" style="text-decoration:none" class="link-dark">' . $editorial->country['country_name'] . ' Falta poder obtener el nombre del país</a></li>
                            <li>Description: ' . $editorial->description . '</a></li>
                        </ul>                        
                    </div>

                    <div class="col-3 ratings text-center align-bottom border-start">
                        <form method="get" action="/editorialmanage/' . $editorial->id . '">
                            <button type="submit" class="btn btn-success btn-block mb-4">Opciones</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>        
        ';            
    }    
    ?>
</div>

@endsection