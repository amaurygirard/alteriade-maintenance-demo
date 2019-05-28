<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client;
use App\Projet;
use App\Contrat;
use App\Intervention;

class ClientController extends Controller
{
    /**
     * Show the profile for the given client.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {

        $client = Client::findOrFail($id);
        $projets = Projet::where('client_id',intval($id))->get();
        $contrats = [];
        $interventions = [];

        foreach($projets as $projet) {

          $instances = Contrat::where('projet_id',intval($projet->id))->get();
          $contrats[$projet->id] = $instances;

          foreach($instances as $contrat) {
            $intervention = Intervention::where('contrat_id',intval($contrat->id))->get()->sortBy('date')->first();
            $interventions[$contrat->id] = $intervention;
          }

        }

        return view('client.single',
        [
          'client' => $client,
          'projets' => $projets,
          'contrats' => $contrats,
          'interventions' => $interventions,
        ]);
    }

    /**
     * Show all clients
     *
     * @param  int  $id
     * @return View
     */
    public function showAll()
    {

        $clients = Client::all();

        return view('client.all', ['clients' => $clients]);
    }

    /**
     * List all clients
     *
     * @param  int  $id
     * @return View
     */
    public function listAll()
    {

        $clients = Client::all();

        return view('welcome', ['clients' => $clients]);
    }

    /**
     * Add new client
     *
     * @param  int  $id
     * @return View
     */
    public function create(Request $request)
    {
      /*
       * Instanciation d'un nouveau client, auquel on attribue le nom passé en requête
       */
      $client = new Client;
      $client->name = $request->name;


      /*
       * Le client est enregistré en BDD
       */
      $client->save();


      /*
       * La relation avec les TeamMembers est également enregistrée en BDD
       */
      $client->teammembers()->attach($request->teammembers);

      return redirect('/client/'.$client->id);
    }
}
