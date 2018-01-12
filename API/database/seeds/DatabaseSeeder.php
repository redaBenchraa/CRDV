<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        /*factory(\App\Models\Centre::class, 3)->create();
        factory(\App\Models\Professionnelle::class, 73)->create();
        factory(\App\Models\Groupe::class, 50)->create();
        factory(\App\Models\Usager::class, 200)->create();
        factory(\App\Models\Categorie::class, 10)->create();
        factory(\App\Models\SousCategorie::class, 100)->create();
        factory(\App\Models\Activite::class, 200)->create();
        factory(\App\Models\Acte::class, 100)->create();
         factory(\App\Models\EmploiDuTemps::class, 500)->create();*/
        factory(\App\Models\CategorieProfessionnelle::class, 250)->create();

    }
}
