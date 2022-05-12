<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Http\Controllers\RoutingController;
use App\Models\AccountBook;
use App\Models\Book;

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

    function editComment($idBook, Request $request){

        if(session_status()==1){
            session_start();
          }

        $findComment = AccountBook::where('account_id', $_SESSION['user_id'])
        ->where('book_id', $idBook)
        ->first();

        if(isset($_POST["save"])){

            if($findComment!=''){

                $findComment->account_id = $_SESSION["user_id"];
                $findComment->book_id = $idBook;
                $findComment->rate = $request->get("rate");
                $findComment->title_review= $request->get("title");
                $findComment->review = $request->get("comment");
                $findComment->date_review = date('Y-m-d');
                $findComment->save();

            }

        }elseif(isset($_POST["deleteComment"])){

            $findComment->delete();

        }

        return $this->profile();


    }

    function profile(){
        if(session_status()==1){
            session_start();
          }
        $userComments = AccountBook::where('account_id', $_SESSION["user_id"])->get();
        $userData = array();
        $i=0;
        

        foreach($userComments as $comment){
            $book = Book::where('id', $comment["book_id"])->get();
            $userData[$i]["rate"] = $comment["rate"];
            $userData[$i]["date_review"] =$comment["date_review"];
            $userData[$i]["title_review"] = $comment["title_review"];
            $userData[$i]["review"] = $comment["review"];
            $userData[$i]["score"] = $book[0]["score"];
            $userData[$i]["book_title"] = $book[0]["title"];
            $userData[$i]["book_id"] = $comment["book_id"];

            $nrate = count($book[0]["accounts"]);
            $ncoments=0;
            for ($j = 0; $j < $nrate; $j++) {
    
                if($book["0"]["accounts"][$j]['pivot']['date_review'] != ""){
                    $ncoments += 1;
                }
            }

            $userData[$i]["comments"]=$ncoments;
            


            $i++;
        }

        $userDB=Account::where('id', $_SESSION["user_id"])->get();
        

        return view('userPanel', compact('userDB', 'userData'));
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

            return $this->profile();

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

                    return $this->profile();
                }

                $message = '<script language="javascript">alert("La contraseña actual no es correcta")</script>';
                $_SESSION["logued"]=$message;
    
                return $this->profile();

            }

            
            $message = '<script language="javascript">alert("La contraseña no esta bien formada")</script>';
            $_SESSION["logued"]=$message;

            return $this->profile();
        }
    }
}
