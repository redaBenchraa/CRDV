<?php

use Faker\Factory as Faker;
use App\Models\Usager;
use App\Repositories\UsagerRepository;

trait MakeUsagerTrait
{
    /**
     * Create fake instance of Usager and save it in database
     *
     * @param array $usagerFields
     * @return Usager
     */
    public function makeUsager($usagerFields = [])
    {
        /** @var UsagerRepository $usagerRepo */
        $usagerRepo = App::make(UsagerRepository::class);
        $theme = $this->fakeUsagerData($usagerFields);
        return $usagerRepo->create($theme);
    }

    /**
     * Get fake instance of Usager
     *
     * @param array $usagerFields
     * @return Usager
     */
    public function fakeUsager($usagerFields = [])
    {
        return new Usager($this->fakeUsagerData($usagerFields));
    }

    /**
     * Get fake data of Usager
     *
     * @param array $postFields
     * @return array
     */
    public function fakeUsagerData($usagerFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'centre_id' => $fake->randomDigitNotNull,
            'nom' => $fake->word,
            'prenom' => $fake->word,
            'age' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $usagerFields);
    }
}
