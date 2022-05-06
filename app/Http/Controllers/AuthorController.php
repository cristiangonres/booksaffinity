<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Country;


class AuthorController extends Controller
{
    function showAllAuthors(){
        Paginator::defaultView('vendor\pagination\bootstrap-4');
        $data=Author::query()
        ->paginate(10);
        return view('authors', compact('data'));
    }

    function showOneAuthor($id){
        $author=Author::where('id', $id)
        ->get();
        return view('author', compact('author'));
    }

    function showAllAuthorsWithOptions(){
        Paginator::defaultView('vendor\pagination\bootstrap-4');
        $data=Author::paginate(10);
        return view('authormanage2', compact('data'));
    }

    function showOneAuthorsWithOptions($id){
        $author=Author::where('id', $id)
        ->get();
        return view('authoroption', compact('author'));
    }

    function updateORdeleteAutor(Request $request){
        // Obteniendo author de la BD al que le haremos update.
        $id=$request->get('authorID');
        $updateAuthor = Author::find($id);

        $country=$request->get('autorCountry');

        // Obteniendo ID del país en la BD.
        $countryID=0;
        $countryModel = Country::where('country_name', $country)->get();
        foreach($countryModel as $getId){
            $countryID=$getId->id;
        }

        // Obtenemos la imagen
        $imageContent="";
        if(isset($_FILES["autorCover"]["tmp_name"])){
            $image=$_FILES["autorCover"]["tmp_name"];
            $imageContent=file_get_contents($image);
        }

        // Obteniendo datos del formulario, posteriormente para hacer el update.
        $name=$request->get('autorName');
        $birthdate=$request->get('autorBirthdate');
        $birthDeath=$request->get('autorDeathdate');
        // Aquí estaría $country, pero está un poco más arriba para buscar su equivalente en id en la BD.

        $description=$request->get('autorDescription');

        // TODO habría que hacer un método para esto, aquí hay repetición de código.
        // Comprobamos que el formato de la fecha del cumpleaños es correcto.
        if (!(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$birthdate))) {
            $birthdate="VALORES DE BIRTHDATE INCORRECTOS";
            return view('afterEditAuthor', compact('id', 'name', 'birthdate', 'birthDeath', 'imageContent' , 'countryID', 'country', 'description'));
        }

        // Comprobamos que el formato de la fecha de muerte es correcto.
        if($birthDeath!=""){
            if (!(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$birthDeath))){
                $birthDeath="VALORES DE DEATH DATE INCORRECTOS";
                return view('afterEditAuthor', compact('id', 'name', 'birthdate', 'birthDeath', 'imageContent' , 'countryID', 'country', 'description'));
            }
        }


        // Comprobamos que el país existe en caso de cambiarse.
        if($countryID==0){
            $countryID="PAÍS NO ENCONTRADO";
            return view('afterEditAuthor', compact('id', 'name', 'birthdate', 'birthDeath', 'imageContent' , 'countryID', 'country', 'description'));
        }

        if ($_POST["button"] == "update") {
            // Actualizando datos de los atributos del autor.
            $updateAuthor->author_name=$name;
            $updateAuthor->birth_date=$birthdate;
            $updateAuthor->death_date=$birthDeath;

            if(!$imageContent==""){
                $updateAuthor->photo=$imageContent;
            }

            $updateAuthor->country_id=$countryID;
            $updateAuthor->description=$description;

            $updateAuthor->save();
        } elseif ($_POST["button"] == "delete") {
            $id=$request->get('authorID');

            $deleteAuthor = Author::find($id);
            $deleteAuthor->delete();
        }

        return view('afterEditAuthor', compact('id', 'name', 'birthdate', 'birthDeath', 'imageContent' , 'countryID', 'country', 'description'));
        //return view('afterEditAuthor')->with('userName', $name);
    }

    function submitAuthor(Request $request){
        $updateAuthor = new Author;
        $nameBD = Author::where('author_name', $request->get('autorName'))->get('author_name');

        if ($nameBD=='[]'){
            $country=$request->get('autorCountry');

            // Obteniendo ID del país en la BD.
            $countryID=0;
            $countryModel = Country::where('country_name', $country)->get();
            foreach($countryModel as $getId){
                $countryID=$getId->id;
            }

            // Obtenemos la imagen
            $imageContent="";
            /*
            * TODO no consigo subir la imagen, dice que el array autorCover no existe.
            */
            $check = getimagesize($_FILES["autorCover"]["tmp_name"]);

            if($check !== false){
                $image=$_FILES["autorCover"]["tmp_name"];
                $imageContent=file_get_contents($image);
            } else {
                $imageContent='Imagen no insertada';
                $name="name aun no procesado";
                $birthdate="birthdate aun no procesado";
                $birthDeath="birthDeath aun no procesado";
                $countryID="countryID por ahora no se ha verificado";
                $description="descrription aun no procesado";
                return view('afterSubmitAuthor', compact('name', 'birthdate', 'birthDeath', 'imageContent' , 'countryID', 'country', 'description'));
            }
            /**/
            // Obteniendo datos del formulario, posteriormente para hacer el update.
            $name=$request->get('autorName');
            $birthdate=$request->get('autorBirthdate');
            $birthDeath=$request->get('autorDeathdate');

            // Aquí estaría $country, pero está un poco más arriba para buscar su equivalente en id en la BD.

            $description=$request->get('autorDescription');

            // Comprobamos que el país existe en caso de cambiarse.
            if($countryID==0){
                $countryID="PAÍS NO ENCONTRADO";
                return view('afterSubmitAuthor', compact('name', 'birthdate', 'birthDeath', 'imageContent' , 'countryID', 'country', 'description'));
            }

            // Actualizando datos de los atributos del autor.
            $updateAuthor->author_name=$name;
            $updateAuthor->birth_date=$birthdate;
            $updateAuthor->death_date=$birthDeath;

            if(!$imageContent==""){
                $updateAuthor->photo=$imageContent;
            } else {
                $imageContent="No se ha subido ninguna imagen";
            }

            $updateAuthor->country_id=$countryID;
            $updateAuthor->description=$description;

            $updateAuthor->save();

            return view('afterSubmitAuthor', compact('name', 'birthdate', 'birthDeath', 'imageContent' , 'countryID', 'country', 'description'));

        } else {
            $imageContent='Imagen no procesada';
            $name="El nombre ya existe en la BD";
            $birthdate="birthdate aun no procesado";
            $birthDeath="birthDeath aun no procesado";
            $countryID="countryID por ahora no se ha verificado";
            $country="country aun no procesado";
            $description="descrription aun no procesado";
            return view('afterSubmitAuthor', compact('name', 'birthdate', 'birthDeath', 'imageContent' , 'countryID', 'country', 'description'));
        }

    }

}
