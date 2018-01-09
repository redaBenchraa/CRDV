<?php

use Faker\Factory as Faker;
use App\Models\Centre;
use App\Repositories\CentreRepository;

trait MakeCentreTrait
{
    /**
     * Create fake instance of Centre and save it in database
     *
     * @param array $centreFields
     * @return Centre
     */
    public function makeCentre($centreFields = [])
    {
        /** @var CentreRepository $centreRepo */
        $centreRepo = App::make(CentreRepository::class);
        $theme = $this->fakeCentreData($centreFields);
        return $centreRepo->create($theme);
    }

    /**
     * Get fake instance of Centre
     *
     * @param array $centreFields
     * @return Centre
     */
    public function fakeCentre($centreFields = [])
    {
        return new Centre($this->fakeCentreData($centreFields));
    }

    /**
     * Get fake data of Centre
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCentreData($centreFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'parametre_id' => $fake->randomDigitNotNull,
            'nom' => $fake->word,
            'adresse' => $fake->word,
            'telephone' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $centreFields);
    }
}
