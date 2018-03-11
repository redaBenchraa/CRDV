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

Route::post('/login', 'LoginController@login');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('/login/refresh', 'LoginController@refresh');
    Route::post('/logout', 'LoginController@logout');
});

/*
Route::post('/login', 'PassportController@login');
Route::post('/register', 'PassportController@register');
Route::post('/login/refresh', 'PassportController@refresh');
Route::group(['middleware' => 'auth:api'], function(){
	Route::post('get-details', 'PassportController@getDetails');
});
*/



Route::post('password/reset', 'ChangePassword@reset');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('me', 'ProfessionnelleAPIController@getMe');
    //Route::resource('centres', 'CentreAPIController');
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
Route::resource('groupes', 'GroupeAPIController');
Route::resource('serafins', 'SerafinAPIController');

Route::prefix('centres')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::get('professionnelles', 'CentreAPIController@professionnelle');
        Route::get('usagers', 'CentreAPIController@usagers');
        Route::get('categories', 'CentreAPIController@categories');
        Route::get('groupes', 'CentreAPIController@groupes');
        Route::prefix('parametres')->group(function () {
            Route::get('', 'CentreAPIController@parametres');
            Route::get('{nom}', 'ParametreAPIController@parametreValue');
            Route::put('', 'CentreAPIController@updateParametres');

        });
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
    Route::get('planned/{bool}', 'ActiviteAPIController@planned');
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
        Route::get('groupe', 'EmploiDuTempsAPIController@groupe');         
    });
});

Route::get('/parametres/{id}/centre', 'ParametreAPIController@centre');

Route::prefix('professionnelles')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::get('centre', 'ProfessionnelleAPIController@centre');
        Route::get('validated', 'ProfessionnelleAPIController@validated');
        Route::get('categories', 'ProfessionnelleAPIController@categories');
        Route::get('emploiDuTemps', 'ProfessionnelleAPIController@emploiDuTemps'); 
        Route::prefix('activites')->group(function () {
            Route::get('', 'ProfessionnelleAPIController@activites'); 
            Route::put('validate/{bool}', 'ActiviteAPIController@valider');
        });        
    });
});

Route::prefix('sous_categories')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::get('categorie', 'SousCategorieAPIController@categorie');
        Route::get('serafin', 'SousCategorieAPIController@serafin');
        Route::get('activites', 'SousCategorieAPIController@activites');                    
    });
});

Route::prefix('usagers')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::get('centre', 'UsagerAPIController@centre');
        Route::get('groupe', 'UsagerAPIController@groupe');
        Route::get('actes', 'UsagerAPIController@actes');
        Route::get('activites', 'UsagerAPIController@activites');                    
    });
});

Route::prefix('groupes')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::get('emploidutemps', 'GroupeAPIController@emploidutemps');
        Route::get('usagers', 'GroupeAPIController@usagers');        
    });
});

Route::prefix('serafins')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::get('souscategories', 'SerafinAPIController@souscategories');
        Route::get('serafin', 'SerafinAPIController@serafin');                    
    });
});

