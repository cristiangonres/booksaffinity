<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Http\Controllers\RoutingController;

class UserController extends Controller
{
    function signUp(Request $request){

        $userName=$request->get('userName');
        $userNameDB=Account::where('username', $userName)->get('username');

        //Validacion de usuario.
        if($userNameDB=='[]'){

            $pass=$request->get('userPass');
            $mail=$request->get('emailUser');

            //Validacion de email.
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)){

                $mailBD=Account::where('email', $mail)->get('email');

                //Validacion de email repetido.
                if($mailBD=='[]'){

                    //validacion de Password.
                    $uppercase=preg_match('@[A-Z]@', $pass);
                    $lowercase=preg_match('@[a-z]@', $pass);
                    $number=preg_match('@[0-9]@', $pass);
                    $leng= strlen($pass)>=6;

                if(!$uppercase || !$lowercase || !$number || !$leng){
                    $pass='';
                }
                    if(!empty($pass)){

                            $newAccount=new Account();
                            $newAccount->username=$userName;
                            $newAccount->user_password=$pass;
                            $newAccount->email=$mail;
                            $newAccount->created_on=date('Y-m-d h:i:s');
                            $newAccount->description=$request->get('description');
                            $newAccount->save();
                            return view('afterSignup')->with('userName', 'Nuevo usuario registrado');

                    } else {
                        return view('afterSignup')->with('userName', 'Password no valido, debe contener minimo 6 digitos, Mayúsculas, minúsculas y numeros.');
                    }
                }else{
                    return view('afterSignup')->with('userName', 'E-mail ya registrado');
                }
            }else{
                return view('afterSignup')->with('userName', 'E-mail no valido');
            }
        } else {
            return view('afterSignup')->with('userName', 'El nombre de usuario ya existe');
        }


    }

    function signIn(Request $request){

        session_start();

        $rc = new RoutingController();
        $rchome = $rc->home();

        if(isset($_POST["sessionopen"])){
            $userName=$request->get('userName');
            $userDB=Account::where('username', $userName)->get();

            if($userDB[0]["username"] == $userName){
                $userPass=$request->get('userPass');

                if($userDB[0]["user_password"] == $userPass){
                    echo '<script language="javascript">';
                    echo 'alert("Registrado con exito")';
                    echo '</script>';
                    $_SESSION["id"]=$userDB[0]["id"];
                    $_SESSION["role"]="admin";
                    $_SESSION["username"]=$userDB[0]["username"];
                    $_SESSION["description"]=$userDB[0]["description"];

                    return $rchome;

                } else {
                    echo '<script language="javascript">';
                    echo 'alert("Password incorrecto")';
                    echo '</script>';
                    return $rchome;
                }

            } else {
                echo '<script language="javascript">';
                echo 'alert("Usuario incorrecto")';
                echo '</script>';
                return $rchome;
            }
        }

        if(isset($_POST["sessionclose"])){

            session_reset();
            session_destroy();
            echo '<script language="javascript">';
            echo 'alert("Session cerrada")';
            echo '</script>';
            return $rchome;
        }

        if(isset($_POST["sessionProfile"])){
            $id=$_SESSION["id"]; // Esto no va yo flipo.
            return view('userPanel')->with($_SESSION);
        }
    }

    function editORdeleteUser(Request $request){
        $idUser=$request->get('userID');
        $desc=$request->get('userDesc');
        $passOld=$request->get('userOldPass');
        $passNew=$request->get('userNewPass');

        $userDB=Account::find($idUser);
        $userDBPass=$userDB->user_password;

        $rc = new RoutingController();
        $rchome = $rc->home();

        if($_POST['button'] == "update"){
            $userDB->description=$desc;
            $userDB->save();

            echo '<script language="javascript">';
            echo 'alert("Usuario actualizado")';
            echo '</script>';

            $info="usuario actualizado";
            //return $rchome;
            return view('afterEditUser', compact('idUser', 'info'));

        }elseif($_POST['button'] == "delete"){
            echo '<script language="javascript">';
            echo 'alert("Usuario borrado")';
            echo '</script>';
            //$userDB->delete();
            
            $info="usuario borrado";
            //return $rchome;
            return view('afterEditUser', compact('idUser', 'info'));

        }elseif($_POST['button'] == 'changePass'){
            if($userDBPass == $passOld){
                //validacion de nueva Password.
                $uppercase=preg_match('@[A-Z]@', $passNew);
                $lowercase=preg_match('@[a-z]@', $passNew);
                $number=preg_match('@[0-9]@', $passNew);
                $leng= strlen($passNew)>=6;

                if($uppercase && $lowercase && $number && $leng){
                    $userDB->user_password=$passNew;
                    $userDB->save();

                    $info="Contraseña cambiada satisfactoriamente";
                    echo '<script language="javascript">';
                    echo 'alert("Contraseña cambiada satisfactoriamente")';
                    echo '</script>';

                    return view('afterEditUser', compact('idUser', 'info'));
                    //return $rchome;
                }
               
            }

            $info="No has introducido correctamente la contraseña anterior";
            return view('afterEditUser', compact('idUser', 'info'));
        }
    }
}
