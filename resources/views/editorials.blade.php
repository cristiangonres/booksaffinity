@extends('layout')

@section('title', 'Editorial Details')

@section('content')

<style>
    #form {
  width: 250px;
  margin: 0 auto;
  height: 50px;
}

#form p {
  text-align: center;
}

#form label {
  font-size: 20px;
}

input[type="radio"] {
  display: none;
}

label {
  color: grey;
}

.clasificacion {
  direction: rtl;
  unicode-bidi: bidi-override;
}

label:hover,
label:hover ~ label {
  color: orange;
}

input[type="radio"]:checked ~ label {
  color: orange;
}
</style>

<div class="row">
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
                          <li>Pais: <a href="/countrybook/' . $editorial->country['id'] . '" style="text-decoration:none" class="link-dark">' . $editorial->country['country_name'] . '</a></li>
                          <li>Description: ' . $editorial->description . '</a></li>
                      </ul>
                  </div>
                </div>
            </div>
        </div>        
        ';            
    }    
    ?>
</div>

@endsection