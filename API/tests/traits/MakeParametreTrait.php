<?php

use Faker\Factory as Faker;
use App\Models\Parametre;
use App\Repositories\ParametreRepository;

trait MakeParametreTrait
{
    /**
     * Create fake instance of Parametre and save it in database
     *
     * @param array $parametreFields
     * @return Parametre
     */
    public function makeParametre($parametreFields = [])
    {
        /** @var ParametreRepository $parametreRepo */
        $parametreRepo = App::make(ParametreRepository::class);
        $theme = $this->fakeParametreData($parametreFields);
        return $parametreRepo->create($theme);
    }

    /**
     * Get fake instance of Parametre
     *
     * @param array $parametreFields
     * @return Parametre
     */
    public function fakeParametre($parametreFields = [])
    {
        return new Parametre($this->fakeParametreData($parametreFields));
    }

    /**
     * Get fake data of Parametre
     *
     * @param array $postFields
     * @return array
     */
    public function fakeParametreData($parametreFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nom' => $fake->randomDigitNotNull,
            'valeur' => $fake->randomDigitNotNull,
            'type' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $parametreFields);
    }
}
