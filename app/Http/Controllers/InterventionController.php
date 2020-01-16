<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Intervention;
use App\Contrat;

class InterventionController extends Controller
{
    /**
     * Authentification nécessaire
     */
    public function __construct()
    {

      $this->middleware('auth');

    }


  /**
   * Add new Intervention
   *
   * @param  int  $id
   * @return View
   */
  public function create(Request $request)
  {
    /**
     * Instanciation d'un nouveau projet,
     * auquel on attribue les attributs passés en requête
     */
    $intervention = new Intervention;

    $intervention->contrat_id = $request->contrat_id;

    $date = \DateTime::createFromFormat('d/m/Y', $request->date);
    $intervention->date = $date->format('Y-m-d H:i:s');

    $intervention->minutes_spent = $request->minutes_spent;
    $intervention->description = $request->description;
    $intervention->is_probono = $request->is_probono;
    $intervention->type = $request->type;


    /**
     * Enregistrement de l'intervention en BDD
     */
    $intervention->save();


    /**
     * La relation avec les Utilisateurs est également enregistrée en BDD
     */
    $intervention->users()->attach($request->users);


    /**
     * Redirection vers la page du projet à la fin de l'opération
     */
    $contrat = Contrat::find($intervention->contrat_id);
    return redirect('/projet/'.$contrat->projet_id);
  }


  /**
   * Edit Intervention
   *
   * @param  int  $id
   * @return View
   */
  public function edit(Request $request, $id)
  {
    /**
     * Instanciation d'un nouveau projet,
     * auquel on attribue les attributs passés en requête
     */
    $intervention = Intervention::find($id);

    // $intervention->contrat_id = $request->contrat_id;

    $date = \DateTime::createFromFormat('d/m/Y', $request->date);
    $intervention->date = $date->format('Y-m-d H:i:s');

    $intervention->minutes_spent = $request->minutes_spent;
    $intervention->description = $request->description;
    $intervention->is_probono = $request->is_probono;
    $intervention->type = $request->type;


    /**
     * Enregistrement de l'intervention en BDD
     */
    $intervention->save();


    /**
     * La relation avec les Utilisateurs est également enregistrée en BDD
     */
    $intervention->users()->sync($request->users);


    /**
     * Redirection vers la page du projet à la fin de l'opération
     */
    $contrat = Contrat::find($intervention->contrat_id);
    return redirect('/projet/'.$contrat->projet_id);
  }
}
