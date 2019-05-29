<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Projet;

class ProjetController extends Controller
{
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
       * La relation avec les TeamMembers est également enregistrée en BDD
       */
      $projet->teammembers()->attach($request->teammembers);


      return redirect('/projet/'.$projet->id);
    }
}
