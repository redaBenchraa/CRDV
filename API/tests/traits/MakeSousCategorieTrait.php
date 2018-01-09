<?php

use Faker\Factory as Faker;
use App\Models\sousCategorie;
use App\Repositories\sousCategorieRepository;

trait MakesousCategorieTrait
{
    /**
     * Create fake instance of sousCategorie and save it in database
     *
     * @param array $sousCategorieFields
     * @return sousCategorie
     */
    public function makesousCategorie($sousCategorieFields = [])
    {
        /** @var sousCategorieRepository $sousCategorieRepo */
        $sousCategorieRepo = App::make(sousCategorieRepository::class);
        $theme = $this->fakesousCategorieData($sousCategorieFields);
        return $sousCategorieRepo->create($theme);
    }

    /**
     * Get fake instance of sousCategorie
     *
     * @param array $sousCategorieFields
     * @return sousCategorie
     */
    public function fakesousCategorie($sousCategorieFields = [])
    {
        return new sousCategorie($this->fakesousCategorieData($sousCategorieFields));
    }

    /**
     * Get fake data of sousCategorie
     *
     * @param array $postFields
     * @return array
     */
    public function fakesousCategorieData($sousCategorieFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'id' => $fake->randomDigitNotNull,
            'intitule' => $fake->word,
            'type' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $sousCategorieFields);
    }
}
