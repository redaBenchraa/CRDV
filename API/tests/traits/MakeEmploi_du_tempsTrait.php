<?php

use Faker\Factory as Faker;
use App\Models\Emploi_du_temps;
use App\Repositories\Emploi_du_tempsRepository;

trait MakeEmploi_du_tempsTrait
{
    /**
     * Create fake instance of Emploi_du_temps and save it in database
     *
     * @param array $emploiDuTempsFields
     * @return Emploi_du_temps
     */
    public function makeEmploi_du_temps($emploiDuTempsFields = [])
    {
        /** @var Emploi_du_tempsRepository $emploiDuTempsRepo */
        $emploiDuTempsRepo = App::make(Emploi_du_tempsRepository::class);
        $theme = $this->fakeEmploi_du_tempsData($emploiDuTempsFields);
        return $emploiDuTempsRepo->create($theme);
    }

    /**
     * Get fake instance of Emploi_du_temps
     *
     * @param array $emploiDuTempsFields
     * @return Emploi_du_temps
     */
    public function fakeEmploi_du_temps($emploiDuTempsFields = [])
    {
        return new Emploi_du_temps($this->fakeEmploi_du_tempsData($emploiDuTempsFields));
    }

    /**
     * Get fake data of Emploi_du_temps
     *
     * @param array $postFields
     * @return array
     */
    public function fakeEmploi_du_tempsData($emploiDuTempsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'professionnelle_id' => $fake->randomDigitNotNull,
            'acte_id' => $fake->randomDigitNotNull,
            'Jour' => $fake->date('Y-m-d H:i:s'),
            'heureDebut' => $fake->date('Y-m-d H:i:s'),
            'heureFin' => $fake->date('Y-m-d H:i:s')
        ], $emploiDuTempsFields);
    }
}
