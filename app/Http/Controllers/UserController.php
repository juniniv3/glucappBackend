<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  /**
      * Store a new user.
      *
      * @param  Request  $request
      * @return Response
      */
     public function register(Request $request)
     {

       //making  a validator to
      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',
        'age' => 'required',
        'diabetes_type'=> 'required'
      ]);

      if ($validator->fails()) {
          return response()->json(['error'=>$validator->errors()], 401);
      }



    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = $request->password;
    $user->age = $request->age;
    $user->diabetes_type = $request->diabetes_type;
    $user->verified_mail = "false";
    $user->save();

    return response('Usuario registrado', 200)
                    ->header('Content-Type', 'application/json');

         //
     }
}
