<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Intervention;

class InterventionController extends Controller
{

  /**
   * Add new Intervention
   *
   * @param  int  $id
   * @return View
   */
  public function create(Request $request)
  {
    // Instanciation d'un nouveau projet, auquel on attribue les attributs passés en requête
    $intervention = new Intervention;

    $intervention->contrat_id = $request->contrat_id;

    $date = \DateTime::createFromFormat('d/m/Y', $request->date);
    $intervention->date = $date->format('Y-m-d H:i:s');

    $intervention->minutes_spent = $request->minutes_spent;

    $intervention->description = $request->description;

    $intervention->save();

    return redirect('/projet/'.$intervention->contrat_id);
  }
}
