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

