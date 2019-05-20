<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client;
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
        $client = Client::find($projet->client_id);
        // return view('client.single',
        // [
        //   'client' => $client,
        //   'projets' => Projet::where('client_id',intval($id))->get(),
        // ]);
        return view('projet.single',
        [
          'projet' => $projet,
          'client' => $client,
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
      // Instanciation d'un nouveau projet, auquel on attribue le nom passé en requête
      $projet = new Projet;
      $projet->name = $request->name;
      $projet->client_id = $request->client_id;

      $projet->save();

      return redirect('/projet/'.$projet->id);
    }
}
