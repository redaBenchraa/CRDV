<?php

use Faker\Factory as Faker;
use App\Models\Adaptation;
use App\Repositories\AdaptationRepository;

trait MakeAdaptationTrait
{
    /**
     * Create fake instance of Adaptation and save it in database
     *
     * @param array $adaptationFields
     * @return Adaptation
     */
    public function makeAdaptation($adaptationFields = [])
    {
        /** @var AdaptationRepository $adaptationRepo */
        $adaptationRepo = App::make(AdaptationRepository::class);
        $theme = $this->fakeAdaptationData($adaptationFields);
        return $adaptationRepo->create($theme);
    }

    /**
     * Get fake instance of Adaptation
     *
     * @param array $adaptationFields
     * @return Adaptation
     */
    public function fakeAdaptation($adaptationFields = [])
    {
        return new Adaptation($this->fakeAdaptationData($adaptationFields));
    }

    /**
     * Get fake data of Adaptation
     *
     * @param array $postFields
     * @return array
     */
    public function fakeAdaptationData($adaptationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'id' => $fake->randomDigitNotNull,
            'nom' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $adaptationFields);
    }
}
