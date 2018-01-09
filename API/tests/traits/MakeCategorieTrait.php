<?php

use Faker\Factory as Faker;
use App\Models\Categorie;
use App\Repositories\CategorieRepository;

trait MakeCategorieTrait
{
    /**
     * Create fake instance of Categorie and save it in database
     *
     * @param array $categorieFields
     * @return Categorie
     */
    public function makeCategorie($categorieFields = [])
    {
        /** @var CategorieRepository $categorieRepo */
        $categorieRepo = App::make(CategorieRepository::class);
        $theme = $this->fakeCategorieData($categorieFields);
        return $categorieRepo->create($theme);
    }

    /**
     * Get fake instance of Categorie
     *
     * @param array $categorieFields
     * @return Categorie
     */
    public function fakeCategorie($categorieFields = [])
    {
        return new Categorie($this->fakeCategorieData($categorieFields));
    }

    /**
     * Get fake data of Categorie
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCategorieData($categorieFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'centre_id' => $fake->randomDigitNotNull,
            'intitule' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $categorieFields);
    }
}
