<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Editorial;
use App\Models\Country;

class EditorialController extends Controller
{
    function editorial(){
        $data = Editorial::all();
        return view('editorials', compact('data'));
    }

    function editorialManage(){
        $data = Editorial::all();
        return view('editorialManage', compact('data'));
    }

    function editorialEdit($id){
        $editorial = Editorial::where('id', $id)->get();
        return view('editorialOption', compact('editorial'));
    }

    function updateOrDeleteEditorial(Request $request){
        // Obtención de data del formulario.
        $id=$request->get('editorialID');
        $name=$request->get('editorialName');
        $fecha=$request->get('editorialDate');
        $country=$request->get('editorialCountry');
        $desc=$request->get('editorialDescription');

        // Obtenemos la editorial de la BD que actualizaremos o borraremos.
        $updateEditorial=Editorial::find($id); // Probablemente tras cambios en BD de error.
        //$updateEditorial=Editorial::find($id); // Esto da error debido a que está mal puesto el campo ID en la BBDD
        
        // Posteriormente se usará para comprobar si el país existe en la BD.
        $countryID=0;
        $countryModel = Country::where('country_name', $country)->get();
        foreach($countryModel as $getId){
            $countryID=$getId->id;
        }

        // Obtenemos la imagen
        $imageContent="";
        $check = getimagesize($_FILES["editorialCover"]["tmp_name"]);
        
        if($check !== false){
            $image=$_FILES["editorialCover"]["tmp_name"];
            $imageContent=file_get_contents($image);
        } else {
            $imageContent='Imagen no insertada';
            $name="name aun no procesado";
            $fecha="fecha aun no procesada";
            $countryID="countryID por ahora no se ha verificado";
            $description="descrription aun no procesado";
            return view('afterSubmitAuthor', compact('name', 'fecha', 'countryID', 'country', 'imageContent', 'desc'));
        }            

        // Comprobamos que el formato de la fecha es correcto.
        if (!(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$fecha))) {
            $fecha="VALORES DE FECHA INCORRECTOS";
            return view('afterEditEditorial', compact('id', 'name', 'fecha' , 'countryID', 'country', 'imageContent', 'desc'));
        } 

        // Comprobamos que el país existe en caso de cambiarse.
        if($countryID==0){
            $countryID="PAÍS NO ENCONTRADO";
            return view('afterEditEditorial', compact('id', 'name', 'fecha' , 'countryID', 'country', 'imageContent', 'desc'));
        }

        if ($_POST["button"] == "update") {     
            // Actualizando datos de los atributos de la editorial.            
            $updateEditorial->editorial_name=$name;
            $updateEditorial->country_id=$countryID;
            $updateEditorial->ini_date=$fecha;
            $updateEditorial->description=$desc;
            $updateEditorial->photo=$imageContent;

            $updateEditorial->save(); // TODO: da error, probablemente a  que deberíamos de obtener el $updateEditorial con ::find($id), hasta que no se modifique la BD es lo que hay.
        } elseif ($_POST["button"] == "delete") {
            //$updateEditorial = Editorial::find($id);
            $updateEditorial->delete(); // TODO: error por lo mismo que el de update.
        }

        return view('afterEditEditorial', compact('id', 'name', 'fecha' , 'countryID', 'country', 'imageContent', 'desc'));
    }

    function submitEditorial(Request $request){
        // Obtención de data del formulario.
        $name=$request->get('editorialName');
        $fecha=$request->get('editorialDate');
        $country=$request->get('editorialCountry');
        $desc=$request->get('editorialDescription');

        // Obteniendo modelo para insertar una nueva editorial.
        $updateEditorial = new Editorial;

        // Comprobando que no exista el nombre de la editorial en la BD.
        $nameBD = Editorial::where('editorial_name', $name)->get('editorial_name');        
        if ($nameBD=='[]'){

            // Obteniendo ID del país en la BD.
            $countryID=0;
            $countryModel = Country::where('country_name', $country)->get();
            foreach($countryModel as $getId){
                $countryID=$getId->id;
            }
            
            // Comprobamos que el país existe en caso de cambiarse.
            if($countryID==0){
                $countryID="PAÍS NO ENCONTRADO";
            }

            // Obtenemos la imagen
            $imageContent="";
            $check = getimagesize($_FILES["editorialCover"]["tmp_name"]);
            
            if($check !== false){
                $image=$_FILES["editorialCover"]["tmp_name"];
                $imageContent=file_get_contents($image);
            } else {
                $imageContent='Imagen no insertada';
                $name="name aun no procesado";
                $fecha="fecha aun no procesada";
                $countryID="countryID por ahora no se ha verificado";
                $description="descrription aun no procesado";
                return view('afterSubmitAuthor', compact('name', 'fecha', 'countryID', 'country', 'imageContent', 'desc'));
            }            

            // Actualizando datos de los atributos del autor.            
            $updateEditorial->editorial_name=$name;
            $updateEditorial->country_id=$countryID;
            $updateEditorial->ini_date=$fecha;                        
            $updateEditorial->description=$desc;
            $updateEditorial->photo=$imageContent;

            $updateEditorial->save();

            return view('afterSubmitEditorial', compact('name', 'fecha' , 'countryID', 'country', 'imageContent', 'desc'));

        } else {
            $name="El nombre ya existe en la BD";
            $fecha="fecha aun no procesado";
            $countryID="countryID por ahora no se ha verificado";
            $country="country aun no procesado";
            $description="descrription aun no procesado";

            return view('afterSubmitEditorial', compact('name', 'fecha' , 'countryID', 'country', 'imageContent', 'desc'));
        }
    }
}
