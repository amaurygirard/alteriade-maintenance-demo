<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client;

class ClientController extends Controller
{
    /**
     * Authentification nécessaire
     */
    public function __construct()
    {

      $this->middleware('auth');

    }

    /**
     * Show the profile for the given client.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {

        $client = Client::findOrFail($id);
        $client->with('projets.contrats')->get();

        return view('client.single',
        [
          'client' => $client,
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
       * La relation avec les Utilisateurs est également enregistrée en BDD
       */
      $client->users()->attach($request->users);

      return redirect('/client/'.$client->id);
    }

    /**
     * Edit client
     *
     * @param  int  $id
     * @return View
     */
    public function edit(Request $request,$id)
    {
      /*
       * Instanciation d'un nouveau client, auquel on attribue le nom passé en requête
       */
      $client = Client::find($id);
      $client->name = $request->name;


      /*
       * Le client est enregistré en BDD
       */
      $client->save();


      /*
       * La relation avec les Utilisateurs est également enregistrée en BDD
       */
      $client->users()->sync($request->users);

      return redirect('/client/'.$client->id);
    }
}
