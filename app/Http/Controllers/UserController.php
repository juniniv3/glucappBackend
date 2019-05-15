<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Registry;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
           $userLoged = $user[0];

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
            * Store a new regis
            *
            * @param  Request  $request
            * @return Response
            */
           public function getRecords(Request $request)
           {

             //making  a validator to
            $validator = Validator::make($request->all(), [
              'user_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()], 401);
            }

            $userLoged = null;

            try {

            $user = App\User::find($request->id_user);

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
               * Store a new user.
               *
               * @param  Request  $request
               * @return Response
               */
              public function addRegistry(Request $request)
              {

                //making  a validator to
               $validator = Validator::make($request->all(), [
                 'user_id' => 'required',
                 'measurement'=>'required',
               ]);

               if ($validator->fails()) {
                   return response()->json(['error'=>$validator->errors()], 401);
               }

               $registry = null;

               try {

               $user = App\User::find($request->id_user);

               $regist = new Registry();
               $regist->measurement = $request->measurement;
               $regist->date = date('Y-m-d H:i:s');;

               $regist->level = 0;
               $table->string('indefinido');
               $table->string('');

               if ($regist->measurement < 70 ) {
                   $regist->level = 1;
                   $table->string('Hipoglucemia');
                   $table->string('Trata de inmediato. Si no sabe cómo busque asistencia médica URGENTEMENTE.');
               }

               if ($regist->measurement >=80 && $regist->measurement  <= 115 ) {
                $regist->level = 2;
                $table->string('Normal');
                $table->string('Felicidades, continue cuidándose.');
               }

               if ($regist->measurement >= 150 && $regist->measurement  <= 180 ) {
                $regist->level = 3;
                $table->string('Nivel Elevado');
                $table->string('Tiene prediabetes o diabetes mal controlada. Busque asistencia médica.');
               }

               if ($regist->measurement > 215 ) {
                $regist->level = 4;
                $table->string('Altamente Elevado');
                $table->string('Está en riesgo de padecer severas complicaciones, como: ceguera, ataque al corazón, daño al riñon, etc.');
               }


               $regist->save();
               $registry = $regist;


               } catch (\Exception $e) {
                  return response()->json(['error'=>$e], 401);

               }

               if ($registry == null) {
                 return response()->json(['error'=>"no se pudo crear el registro"], 401);
               }


             return response()->json(['data' => $registry ],201);
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
