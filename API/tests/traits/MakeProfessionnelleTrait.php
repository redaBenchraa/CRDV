<?php

use Faker\Factory as Faker;
use App\Models\Professionnelle;
use App\Repositories\ProfessionnelleRepository;

trait MakeProfessionnelleTrait
{
    /**
     * Create fake instance of Professionnelle and save it in database
     *
     * @param array $professionnelleFields
     * @return Professionnelle
     */
    public function makeProfessionnelle($professionnelleFields = [])
    {
        /** @var ProfessionnelleRepository $professionnelleRepo */
        $professionnelleRepo = App::make(ProfessionnelleRepository::class);
        $theme = $this->fakeProfessionnelleData($professionnelleFields);
        return $professionnelleRepo->create($theme);
    }

    /**
     * Get fake instance of Professionnelle
     *
     * @param array $professionnelleFields
     * @return Professionnelle
     */
    public function fakeProfessionnelle($professionnelleFields = [])
    {
        return new Professionnelle($this->fakeProfessionnelleData($professionnelleFields));
    }

    /**
     * Get fake data of Professionnelle
     *
     * @param array $postFields
     * @return array
     */
    public function fakeProfessionnelleData($professionnelleFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'centre_id' => $fake->randomDigitNotNull,
            'nom' => $fake->word,
            'prenom' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $professionnelleFields);
    }
}
