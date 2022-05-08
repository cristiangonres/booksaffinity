<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Http\Controllers\RoutingController;

class UserController extends Controller
{
    function signUpView(){
        return view('signup');
    }

    function signUp(Request $request){

        $userName=$request->get('userName');
        $userNameDB=Account::where('username', $userName)->get('username');

        $rc = new RoutingController();
        $rchome = $rc->home();

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
                            $message = '<script language="javascript">alert("Usuario registrado correctamente!")</script>';
                            $_SESSION["logued"]=$message;
                            return $rchome;

                    } else {
                        $message = '<script language="javascript">alert("Password no valido, debe contener minimo 6 digitos, Mayúsculas, minúsculas y numeros.")</script>';
                        $_SESSION["logued"]=$message;
                        return view('signup');
                    }
                }else{
                    
                    $message = '<script language="javascript">alert("Ya existe un usuario con este e-mail.")</script>';
                    $_SESSION["logued"]=$message;
                    return view('signup');
                }
            }else{
            
                $message = '<script language="javascript">alert("E-mail no valido.")</script>';
                $_SESSION["logued"]=$message;
                return view('signup');
            }
        } else {
            $message = '<script language="javascript">alert("El nombre de usuario ya existe.")</script>';
            $_SESSION["logued"]=$message;
            return view('signup');
        }


    }

    function signIn(Request $request){

        session_start();

        $rc = new RoutingController();
        $rchome = $rc->home();

        if(isset($_POST["sessionopen"])){
            $userName=$request->get('userName');
            $userDB=Account::where('username', $userName)->get();

            if(isset($userDB[0]["username"])){
                $userPass=$request->get('userPass');

                if($userDB[0]["user_password"] == $userPass){

                    $_SESSION["rol"]=$userDB[0]["rol"];
                    $_SESSION["username"]=$userDB[0]["username"];
                    $_SESSION["user_id"]=$userDB[0]["id"];
                    $message = '<script language="javascript">alert("Logeado correctamente!")</script>';
                    $_SESSION["logued"]=$message;
                    return $rchome;

                } else {
                    $message = '<script language="javascript">alert("Password incorrecto")</script>';
                    $_SESSION["logued"]=$message;
                    
                    return $rchome;
                }

            } else {
                $message = '<script language="javascript">alert("Usuario incorrecto")</script>';
                $_SESSION["logued"]=$message;

                return $rchome;
            }
        }

        if(isset($_POST["sessionclose"])){

            session_reset();
            session_destroy();
            session_start();
            $message = '<script language="javascript">alert("Session cerrada")</script>';
            $_SESSION["logued"]=$message;
            return $rchome;
        }

        if(isset($_POST["sessionProfile"])){
            $userDB=Account::where('id', $_SESSION["user_id"])->get();

            return view('userPanel', compact('userDB'));
        }
    }

    function profile(){
        session_start();
        $userDB=Account::where('id', $_SESSION["user_id"])->get();
        

        return view('userPanel', compact('userDB'));
    }

    function editORdeleteUser(Request $request){
        session_start();
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

            $_SESSION["description"]=$userDB->description=$desc;

            $message = '<script language="javascript">alert("Usuario actualizado")</script>';
            $_SESSION["logued"]=$message;

            $userDB=Account::where('id', $_SESSION["user_id"])->get();

            return view('userPanel', compact('userDB'));

        }elseif($_POST['button'] == "delete"){

            $userDB->delete();


            session_reset();
            session_destroy();
            session_start();
            $message = '<script language="javascript">alert("Usuario eliminado")</script>';
            $_SESSION["logued"]=$message;
            return $rchome;

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

                    $message = '<script language="javascript">alert("Contraseña cambiada satisfactoriamente")</script>';
                    $_SESSION["logued"]=$message;

                    $userDB=Account::where('id', $_SESSION["user_id"])->get();

                    return view('userPanel', compact('userDB'));
                }

            }

            
            $message = '<script language="javascript">alert("Las contraseñas no coinciden")</script>';
            $_SESSION["logued"]=$message;

            $userDB=Account::where('id', $_SESSION["user_id"])->get();

            return view('userPanel', compact('userDB'));
        }
    }
}
