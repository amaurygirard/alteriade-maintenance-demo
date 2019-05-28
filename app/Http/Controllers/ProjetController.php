<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client;
use App\Projet;
use App\Contrat;
use App\Intervention;

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
        $client = Client::find($projet->client_id);
        $contrats = Contrat::where('projet_id',$id)->get();
        $interventions = [];

        foreach ($contrats as $contrat) {

          $interventions[$contrat->id] = Intervention::where('contrat_id',$contrat->id)->get()->sortByDesc('date');

        }

        return view('projet.single',
        [
          'projet' => $projet,
          'client' => $client,
          'contrats' => $contrats,
          'interventions' => $interventions,
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
