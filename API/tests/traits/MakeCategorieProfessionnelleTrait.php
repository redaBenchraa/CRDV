<?php

use Faker\Factory as Faker;
use App\Models\CategorieProfessionnelle;
use App\Repositories\CategorieProfessionnelleRepository;

trait MakeCategorieProfessionnelleTrait
{
    /**
     * Create fake instance of CategorieProfessionnelle and save it in database
     *
     * @param array $categorieProfessionnelleFields
     * @return CategorieProfessionnelle
     */
    public function makeCategorieProfessionnelle($categorieProfessionnelleFields = [])
    {
        /** @var CategorieProfessionnelleRepository $categorieProfessionnelleRepo */
        $categorieProfessionnelleRepo = App::make(CategorieProfessionnelleRepository::class);
        $theme = $this->fakeCategorieProfessionnelleData($categorieProfessionnelleFields);
        return $categorieProfessionnelleRepo->create($theme);
    }

    /**
     * Get fake instance of CategorieProfessionnelle
     *
     * @param array $categorieProfessionnelleFields
     * @return CategorieProfessionnelle
     */
    public function fakeCategorieProfessionnelle($categorieProfessionnelleFields = [])
    {
        return new CategorieProfessionnelle($this->fakeCategorieProfessionnelleData($categorieProfessionnelleFields));
    }

    /**
     * Get fake data of CategorieProfessionnelle
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCategorieProfessionnelleData($categorieProfessionnelleFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'categorie_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $categorieProfessionnelleFields);
    }
}
