<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Intervention;
use App\Contrat;

class ShowHome extends Controller
{
    /**
     * Authentification nécessaire
     */
    public function __construct()
    {

      $this->middleware('auth');

    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

      /**
       * Requête des 3 dernières interventions,
       * avec les informations concernant le contrat, le projet et le client concernés
       */
      $latest_interventions = Intervention::with('contrat.projet.client')->get()->sortByDesc('date')->unique('contrat_id')->take(3);


      /**
       * Requête des contrats bientôt expirés
       * avec les informations relatives au projet et au client concernés
       */
      $close_to_end_contrats = Contrat::with(['projet.client', 'interventions'])->get()->where('is_close_to_end',true);


      /**
       * Retourne la vue avec les données
       */
      return view('welcome', [
        'latest_interventions' => $latest_interventions,
        'close_to_end_contrats'=> $close_to_end_contrats,
      ]);

    }
}
