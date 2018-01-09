<?php

use Faker\Factory as Faker;
use App\Models\Acte;
use App\Repositories\ActeRepository;

trait MakeActeTrait
{
    /**
     * Create fake instance of Acte and save it in database
     *
     * @param array $acteFields
     * @return Acte
     */
    public function makeActe($acteFields = [])
    {
        /** @var ActeRepository $acteRepo */
        $acteRepo = App::make(ActeRepository::class);
        $theme = $this->fakeActeData($acteFields);
        return $acteRepo->create($theme);
    }

    /**
     * Get fake instance of Acte
     *
     * @param array $acteFields
     * @return Acte
     */
    public function fakeActe($acteFields = [])
    {
        return new Acte($this->fakeActeData($acteFields));
    }

    /**
     * Get fake data of Acte
     *
     * @param array $postFields
     * @return array
     */
    public function fakeActeData($acteFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'usager_id' => $fake->randomDigitNotNull,
            'activite_id' => $fake->randomDigitNotNull,
            'duree' => $fake->randomDigitNotNull,
            'modeSaisie' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $acteFields);
    }
}
