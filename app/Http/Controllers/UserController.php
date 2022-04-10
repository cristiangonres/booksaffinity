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

        if(isset($_POST["sessionopen"])){
            $userName=$request->get('userName');
            $userDB=Account::where('username', $userName)->get();

            if($userDB[0]["username"] == $userName){
                $userPass=$request->get('userPass');

                if($userDB[0]["user_password"] == $userPass){
                    echo '<script language="javascript">';
                    echo 'alert("Registrado con exito")'; 
                    echo '</script>';
                    $_SESSION["role"]="admin";
                    $_SESSION["username"]=$userDB[0]["username"];
                    return RoutingController::home();
                } else {
                    echo '<script language="javascript">';
                    echo 'alert("Password incorrecto")'; 
                    echo '</script>';
                    return RoutingController::home();
                }

            } else {
                echo '<script language="javascript">';
                echo 'alert("Usuario incorrecto")'; 
                echo '</script>';
                return RoutingController::home();
            }
        }

        if(isset($_POST["sessionclose"])){

            session_reset();
            session_destroy();
            echo '<script language="javascript">';
            echo 'alert("Session cerrada")'; 
            echo '</script>';
            return RoutingController::home();
        }
    }
}
