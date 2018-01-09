<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/centres/{id}/professionnelles', 'CentreAPIController@professionnelle');
Route::get('/centres/{id}/categories', 'CentreAPIController@categories');
Route::get('/centres/{id}/usagers', 'CentreAPIController@usagers');
Route::get('/centres/{id}/parametre', 'CentreAPIController@parametre');

Route::get('/actes/{id}/usager', 'ActeAPIController@usager');
Route::get('/actes/{id}/adaptations', 'ActeAPIController@adaptations');
Route::get('/actes/{id}/activite', 'ActeAPIController@activite');

Route::get('/activites/{id}/sousCategorie', 'ActiviteAPIController@sousCategorie');
Route::get('/activites/{id}/usager', 'ActiviteAPIController@usager');
Route::get('/activites/{id}/professionnelle', 'ActiviteAPIController@professionnelle');
Route::get('/activites/{id}/actes', 'ActiviteAPIController@actes');
Route::get('/activites/{id}/emploiDuTemps', 'ActiviteAPIController@emploiDuTemps');


Route::resource('actes', 'ActeAPIController');

Route::resource('activites', 'ActiviteAPIController');

Route::resource('adaptations', 'AdaptationAPIController');

Route::resource('categorie_professionnelles', 'CategorieProfessionnelleAPIController');

Route::resource('categories', 'CategorieAPIController');

Route::resource('centres', 'CentreAPIController');

Route::resource('emploi_du_temps', 'EmploiDuTempsAPIController');

Route::resource('parametres', 'ParametreAPIController');

Route::resource('professionnelles', 'ProfessionnelleAPIController');

Route::resource('usagers', 'UsagerAPIController');

Route::resource('sous_categories', 'SousCategorieAPIController');

