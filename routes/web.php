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
    return view('forms.client_add');
  })->name('ajax_add_client'); // le name permet de générer l'url depuis la vue avec route('ajax_add_client')

  // Formulaire de création d'un projet
  Route::get('/projet_add/{client_id}', function($client_id){
    return view('forms.projet_add',['client_id' => $client_id]);
  })->name('ajax_add_projet'); // le name permet de générer l'url depuis la vue avec route('ajax_add_projet')

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
