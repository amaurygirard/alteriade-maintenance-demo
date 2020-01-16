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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['register' => false]);

Route::get('/logout', function(){
  Auth::logout();
  return redirect('/');
});

Route::get('/', 'ShowHome');

Route::get('/error','ShowAjaxError');

/*
 * Groupe de routes pour les requêtes Ajax
 */
Route::middleware(['App\Http\Middleware\CheckPermission'])->prefix('ajax')->group(function(){

  /*
   * Formulaires de création
   */

  // Formulaire de création d'un client
  Route::get('/client_add', function(){
  return view('forms.client_add',[
      'usermetas' => App\UserMeta::whereIn('team', ['consultant', 'cec'])->get()
  ]);
  })->name('ajax_add_client'); // le name permet de générer l'url depuis la vue avec route('ajax_add_client')

  // Formulaire de création d'un projet
  Route::get('/projet_add/{client_id}', function($client_id){
    return view('forms.projet_add',[
      'client_id' => $client_id,
      'usermetas' => App\UserMeta::whereIn('team', ['consultant', 'cec'])->get()
    ]);
  })->name('ajax_add_projet'); // le name permet de générer l'url depuis la vue avec route('ajax_add_projet')

  // Formulaire de création d'un contrat
  Route::get('/contrat_add/{projet_id}', function($projet_id){
    return view('forms.contrat_add',[
      'projet_id' => $projet_id
    ]);
  })->name('ajax_add_contrat'); // le name permet de générer l'url depuis la vue avec route('ajax_add_projet')

  // Formulaire de création d'une intervention
  Route::get('/intervention_add/{contrat_id}', function($contrat_id){
    return view('forms.intervention_add',[
      'contrat_id' => $contrat_id,
      'usermetas' => App\UserMeta::whereIn('team', ['web'])->get()
    ]);
  })->name('ajax_add_intervention'); // le name permet de générer l'url depuis la vue avec route('ajax_add_projet')

  // Formulaire de création d'un utilisateur
  Route::get('/user_add/{team}', function($team){
    return view('forms.user_add',[
      'team' => $team,
    ]);
  })->name('ajax_add_user'); // le name permet de générer l'url depuis la vue avec route('ajax_add_projet')

  /*
   * Formulaires de modification
   */

  // Formulaire de modification d'un client
  Route::get('/projet_edit/{client_id}', function($client_id){
    return view('forms.client_edit',[
      'client' => App\Client::find($client_id),
      'usermetas' => App\UserMeta::whereIn('team', ['consultant', 'cec'])->get()
    ]);
  })->name('ajax_edit_client'); // le name permet de générer l'url depuis la vue avec route('ajax_add_projet')


  // Formulaire de modification d'un projet
  Route::get('/projet_edit/{projet_id}', function($projet_id){
    return view('forms.projet_edit',[
      'projet' => App\Projet::find($projet_id),
      'usermetas' => App\UserMeta::whereIn('team', ['consultant', 'cec'])->get()
    ]);
  })->name('ajax_edit_projet'); // le name permet de générer l'url depuis la vue avec route('ajax_add_projet')

  // Formulaire de modification d'un contrat
  Route::get('/contrat_edit/{contrat_id}', function($contrat_id){
    return view('forms.contrat_edit',[
      'contrat_id' => $contrat_id,
      'contrat' => App\Contrat::find($contrat_id),
    ]);
  })->name('ajax_edit_contrat'); // le name permet de générer l'url depuis la vue avec route('ajax_add_projet')

  // Formulaire de modification d'une intervention
  Route::get('/intervention_edit/{intervention_id}', function($intervention_id){
    return view('forms.intervention_edit',[
      'intervention_id' => $intervention_id,
      'intervention' => App\Intervention::find($intervention_id),
      'usermetas' => App\UserMeta::whereIn('team', ['web'])->get()
    ]);
  })->name('ajax_edit_intervention'); // le name permet de générer l'url depuis la vue avec route('ajax_add_projet')

});

/*
 * Groupe de routes relatives au client
 */
Route::prefix('client')->group(function(){

  // Création d'un nouveau client
  Route::post('/create', 'ClientController@create');
  Route::patch('/{id}/edit', 'ClientController@edit');

  Route::get('/{id}', 'ClientController@show')->name('client_single');

});

/*
 * Groupe de routes relatives au projet
 */
Route::prefix('projet')->group(function(){

  // Création d'un nouveau client
  Route::post('/create', 'ProjetController@create');
  Route::patch('/{id}/edit', 'ProjetController@edit');

  Route::get('/{id}', 'ProjetController@show')->name('projet_single');

});

/*
 * Groupe de routes relatives au contrat
 */
Route::prefix('contrat')->group(function(){

  // Création d'un nouveau client
  Route::post('/create', 'ContratController@create');
  Route::patch('/{id}/edit', 'ContratController@edit');

  Route::get('/{id}', 'ContratController@show')->name('contrat_single');

});

/*
 * Groupe de routes relatives à l'intervention
 */
Route::prefix('intervention')->group(function(){

  // Création d'un nouveau client
  Route::post('/create', 'InterventionController@create');
  Route::patch('/{id}/edit', 'InterventionController@edit');

});

/*
 * Groupe de routes relatives aux utilisateurs
 */
Route::prefix('users')->group(function(){

  // Affichage de la vue principale
  Route::get('/', function(){
    return view('users.all', [
      'users_web' => App\UserMeta::whereIn('team',['web'])->get(),
      'users_cec' => App\UserMeta::whereIn('team',['cec'])->get(),
      'users_consultant' => App\UserMeta::whereIn('team',['consultant'])->get(),
    ]);
  });

  // Création d'un nouvel utilisateur
  Route::post('/create', 'UserController@create');

});
