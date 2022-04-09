<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;




class UserController extends Controller
{
    public function insertar(Request $request){

        $user = new Account;

      
        $user->username=$request->get('username');
        $user->user_password=$request->get('user_password');
        $user->email=$request->get('email');
        $user->created_on= date('Y-m-d h:i:s');
        $user->description=$request->get('description');

        $user->save();

        imprime();



    

    }
}
