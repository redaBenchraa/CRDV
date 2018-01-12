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

Route::resource('centres', 'CentreAPIController');
Route::resource('activites', 'ActiviteAPIController');
Route::resource('actes', 'ActeAPIController');
Route::resource('adaptations', 'AdaptationAPIController');
Route::resource('categorie_professionnelles', 'CategorieProfessionnelleAPIController');
Route::resource('categories', 'CategorieAPIController');
Route::resource('emploi_du_temps', 'EmploiDuTempsAPIController');
Route::resource('parametres', 'ParametreAPIController');
Route::resource('professionnelles', 'ProfessionnelleAPIController');
Route::resource('usagers', 'UsagerAPIController');
Route::resource('sous_categories', 'SousCategorieAPIController');
Route::resource('actes', 'ActeAPIController');

Route::prefix('centres')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::get('professionnelles', 'CentreAPIController@professionnelle');
        Route::get('usagers', 'CentreAPIController@usagers');
        Route::get('parametre', 'CentreAPIController@parametre');
        Route::get('categories', 'CentreAPIController@categories');
    });
});

Route::prefix('actes')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::get('usager', 'ActeAPIController@usager');
        Route::get('adaptations', 'ActeAPIController@adaptations');
        Route::get('activites', 'ActeAPIController@activites');
    });
});

Route::prefix('activites')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::get('sousCategorie', 'ActiviteAPIController@sousCategorie');
        Route::get('usager', 'ActiviteAPIController@usager');
        Route::get('professionnelle', 'ActiviteAPIController@professionnelle');
        Route::get('acte', 'ActiviteAPIController@acte');
        Route::get('emploiDuTemps', 'ActiviteAPIController@emploiDuTemps');
    });
});

Route::prefix('categories')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::get('centre', 'CategorieAPIController@centre');
        Route::get('professionnelles', 'CategorieAPIController@professionnelles');
        Route::get('sousCategories', 'CategorieAPIController@sousCategories');
    });
});

Route::prefix('categorie_professionnelles')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::get('categorie', 'CategorieProfessionnelleAPIController@categorie');
        Route::get('professionnelle', 'CategorieProfessionnelleAPIController@professionnelle');        
    });
});

Route::prefix('emploi_du_temps')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::get('activite', 'EmploiDuTempsAPIController@activite');
        Route::get('professionnelle', 'EmploiDuTempsAPIController@professionnelle');            
    });
});

Route::get('/parametres/{id}/centres', 'ParametreAPIController@centres');

Route::prefix('professionnelles')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::get('centre', 'ProfessionnelleAPIController@centre');
        Route::get('activites', 'ProfessionnelleAPIController@activites');
        Route::get('categories', 'ProfessionnelleAPIController@categories');
        Route::get('emploiDuTemps', 'ProfessionnelleAPIController@emploiDuTemps');                    
    });
});

Route::prefix('sous_categories')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::get('categorie', 'SousCategorieAPIController@categorie');
        Route::get('activites', 'SousCategorieAPIController@activites');                    
    });
});

Route::prefix('usagers')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::get('centre', 'UsagerAPIController@centre');
        Route::get('actes', 'UsagerAPIController@actes');
        Route::get('activites', 'UsagerAPIController@activites');                    
    });
});

Route::resource('groupes', 'GroupeAPIController');