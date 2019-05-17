<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client;

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
        return view('client.single', ['client' => Client::findOrFail($id)]);
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
      // Instanciation d'un nouveau client, auquel on attribue le nom passé en requête
      $client = new Client;
      $client->name = $request->name;

      $client->save();

      return redirect('/client/'.$client->id);
    }
}
