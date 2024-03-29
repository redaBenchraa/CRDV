<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$factory->define(\App\Models\Acte::class, function (Faker $faker) {
    return [
        'duree' => $faker->numberBetween(5,45),
        'modeSaisie' => $faker->streetSuffix,
        'usager_id' =>  $faker->numberBetween(\DB::table('usager')->min('id'), \DB::table('usager')->max('id'))
    ];
});

$factory->define(\App\Models\CategorieProfessionnelle::class, function (Faker $faker) {
    return [
        'professionnelle_id' =>  $faker->numberBetween(\DB::table('professionnelle')->min('id'), \DB::table('professionnelle')->max('id')),
        'categorie_id' =>  $faker->numberBetween(\DB::table('categorie')->min('id'), \DB::table('categorie')->max('id'))
    ];
});

$factory->define(\App\Models\Groupe::class, function (Faker $faker) {
    return [
        'nom' => $faker->firstName(),
        'centre_id' =>  $faker->numberBetween(\DB::table('centre')->min('id'), \DB::table('centre')->max('id')),
    ];
});

$factory->define(\App\Models\Usager::class, function (Faker $faker) {
    return [
        'nom' => $faker->firstName(),
        'prenom' => $faker->lastName,
        'date_de_naissance' => $faker->date(),
        'centre_id' =>  $faker->numberBetween(\DB::table('centre')->min('id'), \DB::table('centre')->max('id')),
        'groupe_id' =>  $faker->numberBetween(\DB::table('groupe')->min('id'), \DB::table('groupe')->max('id')),
    ];
});

$factory->define(\App\Models\EmploiDuTemps::class, function (Faker $faker) {
    return [
        'jour' => $faker->numberBetween(1,21),
        'heureDebut' => $faker->time('H:i:s'),
        'heureFin' => $faker->time('H:i:s'),
        'professionnelle_id' =>  $faker->numberBetween(\DB::table('professionnelle')->min('id'), \DB::table('professionnelle')->max('id')),
        'activite_id' =>  $faker->numberBetween(\DB::table('activite')->min('id'), \DB::table('activite')->max('id')),
    ];
});

$factory->define(\App\Models\Centre::class, function (Faker $faker) {
    return [
        'nom' => $faker->name,
        'adresse' => $faker->address,
        'telephone' => $faker->phoneNumber
        
    ];
});

$factory->define(\App\Models\Categorie::class, function (Faker $faker) {
    return [
        'intitule' => $faker->title,
        'centre_id' =>  $faker->numberBetween(\DB::table('centre')->min('id'), \DB::table('centre')->max('id')),
    ];
});


$factory->define(\App\Models\SousCategorie::class, function (Faker $faker) {
    return [
        'type' => $faker->boolean,
        'intitule' => $faker->title,
        'categorie_id' =>  $faker->numberBetween(\DB::table('categorie')->min('id'), \DB::table('categorie')->max('id')),
        'serafin_id' =>  $faker->numberBetween(\DB::table('serafin')->min('id'), \DB::table('serafin')->max('id')),
    ];
});


$factory->define(\App\Models\Serafin::class, function (Faker $faker) {
    return [
        'code' => $faker->name,
        'intitule' => $faker->title,
        //'serafin_id' =>  $faker->numberBetween(\DB::table('serafin')->min('id'), \DB::table('serafin')->max('id')),
    ];
});


$factory->define(\App\Models\Professionnelle::class, function (Faker $faker) {
    $name = str_replace(" ", "_", $faker->firstName);
    $lname = str_replace(" ", "_", $faker->lastName);
    $centre_id =$faker->numberBetween(\DB::table('centre')->min('id'), \DB::table('centre')->max('id'));
    return [
        'nom' => $name,
        'prenom' => $lname,
        'username' => $name.'.'.$lname.'.'.$centre_id,
        'centre_id' =>  $centre_id,
        'password' => app('hash')->make('password'),
        'type' => $faker->boolean
    ];
});

$factory->define(\App\Models\Activite::class, function (Faker $faker) {
    return [
        'duree' => $faker->numberBetween(5,45),
        'cloture' => $faker->boolean,
        'planifie' => $faker->boolean,
        'professionnelle_id' =>  $faker->numberBetween(\DB::table('professionnelle')->min('id'), \DB::table('professionnelle')->max('id')),
        'categorie_id' =>  $faker->numberBetween(\DB::table('categorie')->min('id'), \DB::table('categorie')->max('id')),
        'usager_id' =>  $faker->numberBetween(\DB::table('usager')->min('id'), \DB::table('centre')->max('id')),
        'sous_categorie_id' =>  $faker->numberBetween(\DB::table('sousCategorie')->min('id'), \DB::table('sousCategorie')->max('id')),
        'acte_id' =>  $faker->numberBetween(\DB::table('acte')->min('id'), \DB::table('acte')->max('id'))
    ];
});


