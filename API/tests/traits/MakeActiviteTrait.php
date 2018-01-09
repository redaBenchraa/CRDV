<?php

use Faker\Factory as Faker;
use App\Models\Activite;
use App\Repositories\ActiviteRepository;

trait MakeActiviteTrait
{
    /**
     * Create fake instance of Activite and save it in database
     *
     * @param array $activiteFields
     * @return Activite
     */
    public function makeActivite($activiteFields = [])
    {
        /** @var ActiviteRepository $activiteRepo */
        $activiteRepo = App::make(ActiviteRepository::class);
        $theme = $this->fakeActiviteData($activiteFields);
        return $activiteRepo->create($theme);
    }

    /**
     * Get fake instance of Activite
     *
     * @param array $activiteFields
     * @return Activite
     */
    public function fakeActivite($activiteFields = [])
    {
        return new Activite($this->fakeActiviteData($activiteFields));
    }

    /**
     * Get fake data of Activite
     *
     * @param array $postFields
     * @return array
     */
    public function fakeActiviteData($activiteFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'professionnelle_id' => $fake->randomDigitNotNull,
            'usager_id' => $fake->randomDigitNotNull,
            'categorie_id' => $fake->randomDigitNotNull,
            'sousCategorie_id' => $fake->randomDigitNotNull,
            'duree' => $fake->randomDigitNotNull,
            'cloture' => $fake->word,
            'planifie' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $activiteFields);
    }
}
