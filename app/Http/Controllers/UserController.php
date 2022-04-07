<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class UserController extends Controller
{
    function signUp(Request $request){
        //include('UserControllerFunctions.inc.php');

        $newAccount=new Account();

        $userName=$request->get('userName');        
        $userNameDB=Account::where('username', $userName)->get('username');
        
        /*
        $nameOk=validateNombre($request->get('name'));
        $surOk=validateSur($request->get('surNameUser'));
        $lastOk=validateLast($request->get('lastNameUser'));
        $dateOk=validateFecha($request->get('dateUser'));
        $emailOk=validateEmail($request->get('emailUser'));
        $userOk=validateUser($request->get('userName'));
        $passOk=validatePass($request->get('userPass'));             
        */

        /*
        if($userNameDB=='[]'){
            $userOk=$request->get('nameUser');
        } else {
            return view('afterSignup')->with('userName', 'El nombre de usuario existe');
        }

        if($nameOk){

        } else {
            return view('afterSignup')->with('userName', $nameOk);    
        }

        if($surOk){

        } else {
            return view('afterSignup')->with('userName', 'Apellido vacío');
        }

        if($lastOk){
 
        } else {
            return view('afterSignup')->with('userName', 'Segundo apellido vacío');    
        }

        if($dateOk){
            
        } else {
            return view('afterSignup')->with('userName', 'Fecha vacía');    
        }

        if($emailOk){
            
        } else {
            return view('afterSignup')->with('userName', 'Email vacío');
        }

        if($userOk){
            
        } else {
            return view('afterSignup')->with('userName', 'Usuario vacío');   
        }

        if($passOk){
            
        } else {
            return view('afterSignup')->with('userName', 'Pass incorrecta');    
        }
        
        
        if(!empty($descOk)){
            $newAccount->username=$userOk;
            $newAccount->user_password=$passOk;
            $newAccount->email=$emailOk;
            $newAccount->created_on=date('Y-m-d h:i:s');
            $newAccount->description='TODO'; // TODO falta poner en el formulario una descripción.
            $newAccount->save();
            return view('afterSignup')->with('userName', 'Nuevo usuario registrado');
        } else {
            return view('afterSignup')->with('userName', 'Falta descripción');
        } 
        */
        
        if($userNameDB=='[]'){
            $nameOk=$request->get('name');
            if(!empty($nameOk)){
                $surOk=$request->get('surNameUser');
                if(!empty($surOk)){
                    $lastOk=$request->get('lastNameUser');
                    if(!empty($lastOk)){
                        $dateOk=$request->get('dateUser');
                        if(!empty($dateOk)){
                            $emailOk=$request->get('emailUser');
                            if(!empty($emailOk)){
                                $userOk=$request->get('userName');
                                if(!empty($userOk)){
                                    $passOk=($request->get('userPass'));
                                    $uppercase=preg_match('@[A-Z]@', $passOk);
                                    $lowercase=preg_match('@[a-z]@', $passOk);
                                    $number=preg_match('@[0-9]@', $passOk);

                                    if(!$uppercase || !$lowercase || !$number){
                                        $passOk='';
                                    }

                                    if(!empty($passOk)){
                                        $descOk=$request->get('description');
                                        if(!empty($descOk)){
                                            $newAccount->username=$userOk;
                                            $newAccount->user_password=$passOk;
                                            $newAccount->email=$emailOk;
                                            $newAccount->created_on=date('Y-m-d h:i:s');
                                            $newAccount->description='TODO'; // TODO falta poner en el formulario una descripción.
                                            $newAccount->save();
                                            return view('afterSignup')->with('userName', 'Nuevo usuario registrado');
                                        } else {
                                            return view('afterSignup')->with('userName', 'Falta descripción');
                                        }                                                                                
                                    } else {
                                        return view('afterSignup')->with('userName', 'Pass incorrecta');    
                                    }
                                } else {
                                    return view('afterSignup')->with('userName', 'Usuario vacío');   
                                }
                            } else {
                                return view('afterSignup')->with('userName', 'Email vacío');
                            }
                        } else {
                            return view('afterSignup')->with('userName', 'Fecha vacía');    
                        }
                    } else {
                        return view('afterSignup')->with('userName', 'Segundo apellido vacío');    
                    }
                } else {
                    return view('afterSignup')->with('userName', 'Apellido vacío');
                }
            } else {
                return view('afterSignup')->with('userName', 'Nombre vacío');    
            }
            

            return view('afterSignup')->with('userName', 'El nombre de usuario no existe');
        } else {
            return view('afterSignup')->with('userName', 'El nombre de usuario existe');
        }
        
        
    }

    function signIn(Request $request){
        $userName=$request->get('userName'); 
        $userNameDB=Account::where('username', $userName)->get('username');

        if($userNameDB != '[]'){
            $userPass=$request->get('userPass');
            $userPassDB=Account::where('user_password', $userPass)->get('user_password');
            if($userPassDB != '[]'){
                return view('afterSignup')->with('userName', 'Te has registrado');
            } else {
                return view('afterSignup')->with('userName', 'No debería dar pistas pero pass incorrecta');
            }

        } else {
            return view('afterSignup')->with('userName', 'El usuario no existe');
        }

        return view('afterSignup')->with('userName', $userName);
    }
}
