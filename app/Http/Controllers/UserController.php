<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\UserMeta;

class UserController extends Controller
{
    public function create(Request $request)
    {
      /**
       * Instantie l'utilisateur et lui attribue les paramètres passés en requête
       */
      $user = new User;
      $user->name = $request->first_name . ' ' . $request->last_name;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);

      /**
       * Enregistre l'utilisateur en BDD
       */
      $user->save();

      /**
       * Instancie les métadonnées de l'utilisateur et leur attribue les paramètres passés en requête
       */
      $userMeta = new UserMeta;
      $userMeta->first_name = $request->first_name;
      $userMeta->last_name = $request->last_name;
      $userMeta->team = $request->team;
      $userMeta->user_id = $user->id;

      /**
       * Enregistre les meta en BDD
       */
       $userMeta->save();

      /**
       * Redirige vers la page des utilisateurs
       */
      return redirect('/users');
    }
}
