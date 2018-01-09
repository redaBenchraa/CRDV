<?php

use Faker\Factory as Faker;
use App\Models\Categorie_Professionnelle;
use App\Repositories\Categorie_ProfessionnelleRepository;

trait MakeCategorie_ProfessionnelleTrait
{
    /**
     * Create fake instance of Categorie_Professionnelle and save it in database
     *
     * @param array $categorieProfessionnelleFields
     * @return Categorie_Professionnelle
     */
    public function makeCategorie_Professionnelle($categorieProfessionnelleFields = [])
    {
        /** @var Categorie_ProfessionnelleRepository $categorieProfessionnelleRepo */
        $categorieProfessionnelleRepo = App::make(Categorie_ProfessionnelleRepository::class);
        $theme = $this->fakeCategorie_ProfessionnelleData($categorieProfessionnelleFields);
        return $categorieProfessionnelleRepo->create($theme);
    }

    /**
     * Get fake instance of Categorie_Professionnelle
     *
     * @param array $categorieProfessionnelleFields
     * @return Categorie_Professionnelle
     */
    public function fakeCategorie_Professionnelle($categorieProfessionnelleFields = [])
    {
        return new Categorie_Professionnelle($this->fakeCategorie_ProfessionnelleData($categorieProfessionnelleFields));
    }

    /**
     * Get fake data of Categorie_Professionnelle
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCategorie_ProfessionnelleData($categorieProfessionnelleFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'categorie_id' => $fake->randomDigitNotNull
        ], $categorieProfessionnelleFields);
    }
}
