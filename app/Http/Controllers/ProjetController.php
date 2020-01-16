<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Projet;

class ProjetController extends Controller
{
    /**
     * Authentification nécessaire
     */
    public function __construct()
    {

      $this->middleware('auth');

    }

    /**
     * Show the profile for the given projet.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {

        $projet = Projet::findOrFail($id);
        $projet->with(['client','contrats'])->get();

        return view('projet.single',
        [
          'projet' => $projet,
        ]);
    }

    /**
     * Add new projet
     *
     * @param  int  $id
     * @return View
     */
    public function create(Request $request)
    {
      /*
       * Instanciation d'un nouveau projet
       * auquel on attribue le nom passé en requête
       */
      $projet = new Projet;
      $projet->name = $request->name;
      $projet->client_id = $request->client_id;


      /*
       * Enregistrement du projet en BDD
       */
      $projet->save();


      /*
       * La relation avec les Utilisateurs est également enregistrée en BDD
       */
      $projet->users()->attach($request->users);


      return redirect('/projet/'.$projet->id);
    }

    /**
     * Edit projet
     *
     * @param  int  $id
     * @return View
     */
    public function edit(Request $request,$id)
    {
      /*
       * Instanciation d'un nouveau projet
       * auquel on attribue le nom passé en requête
       */
      $projet = Projet::find($id);
      $projet->name = $request->name;


      /*
       * Enregistrement du projet en BDD
       */
      $projet->save();


      /*
       * La relation avec les Utilisateurs est également enregistrée en BDD
       */
      $projet->users()->sync($request->users);


      return redirect('/projet/'.$projet->id);
    }
}
