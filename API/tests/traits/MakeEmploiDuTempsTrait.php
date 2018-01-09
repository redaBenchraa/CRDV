<?php

use Faker\Factory as Faker;
use App\Models\EmploiDuTemps;
use App\Repositories\EmploiDuTempsRepository;

trait MakeEmploiDuTempsTrait
{
    /**
     * Create fake instance of EmploiDuTemps and save it in database
     *
     * @param array $emploiDuTempsFields
     * @return EmploiDuTemps
     */
    public function makeEmploiDuTemps($emploiDuTempsFields = [])
    {
        /** @var EmploiDuTempsRepository $emploiDuTempsRepo */
        $emploiDuTempsRepo = App::make(EmploiDuTempsRepository::class);
        $theme = $this->fakeEmploiDuTempsData($emploiDuTempsFields);
        return $emploiDuTempsRepo->create($theme);
    }

    /**
     * Get fake instance of EmploiDuTemps
     *
     * @param array $emploiDuTempsFields
     * @return EmploiDuTemps
     */
    public function fakeEmploiDuTemps($emploiDuTempsFields = [])
    {
        return new EmploiDuTemps($this->fakeEmploiDuTempsData($emploiDuTempsFields));
    }

    /**
     * Get fake data of EmploiDuTemps
     *
     * @param array $postFields
     * @return array
     */
    public function fakeEmploiDuTempsData($emploiDuTempsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'professionnelle_id' => $fake->randomDigitNotNull,
            'acte_id' => $fake->randomDigitNotNull,
            'jour' => $fake->randomDigitNotNull,
            'heureDebut' => $fake->word,
            'heureFin' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $emploiDuTempsFields);
    }
}
