<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', 'ClientController@listAll');

/*
 * Groupe de routes pour les requêtes Ajax
 */
Route::prefix('ajax')->group(function(){

  // Formulaire de création d'un client
  Route::get('/client_add', function(){
  return view('forms.client_add',['teamMembers' => App\TeamMember::all()]);
  })->name('ajax_add_client'); // le name permet de générer l'url depuis la vue avec route('ajax_add_client')

  // Formulaire de création d'un projet
  Route::get('/projet_add/{client_id}', function($client_id){
    return view('forms.projet_add',['client_id' => $client_id, 'teamMembers' => App\TeamMember::all()]);
  })->name('ajax_add_projet'); // le name permet de générer l'url depuis la vue avec route('ajax_add_projet')

  // Formulaire de création d'un contrat
  Route::get('/contrat_add/{projet_id}', function($projet_id){
    return view('forms.contrat_add',['projet_id' => $projet_id]);
  })->name('ajax_add_contrat'); // le name permet de générer l'url depuis la vue avec route('ajax_add_projet')

  // Formulaire de création d'une intervention
  Route::get('/intervention_add/{contrat_id}', function($contrat_id){
    return view('forms.intervention_add',['contrat_id' => $contrat_id]);
  })->name('ajax_add_intervention'); // le name permet de générer l'url depuis la vue avec route('ajax_add_projet')

});

/*
 * Groupe de routes relatives au client
 */
Route::prefix('client')->group(function(){

  // Création d'un nouveau client
  Route::post('/create', 'ClientController@create');

  Route::get('/{id}', 'ClientController@show')->name('client_single');

});

/*
 * Groupe de routes relatives au projet
 */
Route::prefix('projet')->group(function(){

  // Création d'un nouveau client
  Route::post('/create', 'ProjetController@create');

  Route::get('/{id}', 'ProjetController@show')->name('projet_single');

});

/*
 * Groupe de routes relatives au contrat
 */
Route::prefix('contrat')->group(function(){

  // Création d'un nouveau client
  Route::post('/create', 'ContratController@create');

  Route::get('/{id}', 'ContratController@show')->name('contrat_single');

});

/*
 * Groupe de routes relatives à l'intervention
 */
Route::prefix('intervention')->group(function(){

  // Création d'un nouveau client
  Route::post('/create', 'InterventionController@create');

});
