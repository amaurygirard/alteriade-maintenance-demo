<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contrat;
use App\Projet;
use App\Client;
use App\Intervention;

class ContratController extends Controller
{
    /**
     * Show the profile for the given contrat.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {

        $contrat = Contrat::findOrFail($id);
        $projet = Projet::find($contrat->projet_id);
        $client = Client::find($projet->client_id);
        $interventions = Intervention::where('contrat_id',intval($id))->get();

        return view('contrat.single',
        [
          'contrat' => $contrat,
          'projet' => $projet,
          'client' => $client,
          'interventions' => $interventions,
        ]);
    }

    /**
     * Add new contrat
     *
     * @param  int  $id
     * @return View
     */
    public function create(Request $request)
    {
      // Instanciation d'un nouveau projet, auquel on attribue les attributs passés en requête
      $contrat = new Contrat;

      $contrat->name = $request->name;
      $contrat->projet_id = $request->projet_id;
      $contrat->type = $request->type;

      $start_date = \DateTime::createFromFormat('d/m/Y', $request->start_date);
      $contrat->start_date = $start_date->format('Y-m-d H:i:s');

      if($request->end_date) {
        $end_date = \DateTime::createFromFormat('d/m/Y', $request->end_date);
        $contrat->end_date = $end_date->format('Y-m-d H:i:s');
      }

      if($request->minutes_in_forfait) {
        $contrat->minutes_in_forfait = ceil(floatval(preg_replace('/,/', '.', $request->minutes_in_forfait)) * 60);
      }

      $contrat->save();

      return redirect('/contrat/'.$contrat->id);
    }
}
