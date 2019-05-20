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

});

/*
 * Groupe de routes relatives au client
 */
Route::prefix('client')->group(function(){

  // Création d'un nouveau client
  Route::post('/create', 'ClientController@create');

  Route::get('/{id}', 'ClientController@show')->name('client_single');

});
