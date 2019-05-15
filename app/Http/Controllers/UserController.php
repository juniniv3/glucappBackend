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

    return response()->json(['data' => "usuario creado" ],201);
         //
     }



     /**
         * Store a new user.
         *
         * @param  Request  $request
         * @return Response
         */
        public function login(Request $request)
        {

          //making  a validator to
         $validator = Validator::make($request->all(), [

           'email' => 'required',
           'password' => 'required',
         ]);

         if ($validator->fails()) {
             return response()->json(['error'=>$validator->errors()], 401);
         }

         $userLoged = null;
         try {
           $user = DB::table('users')
           ->where('email', $request->email)
           ->where('password', $request->password)
           ->get();
           $userLoged = $user;

         } catch (\Exception $e) {
            return response()->json(['error'=>$e], 401);

         }

         if ($userLoged==null) {
           return response()->json(['error'=> "usuario no encontrado"], 401);
         }

       return response()->json(['data' => $userLoged ],201);
            //
        }



        /**
            * Check server.
            *
            * @param  Request  $request
            * @return Response
            */
           public function check()
           {

          return response()->json(['data' => "server online" ],200);
               //
           }
}
