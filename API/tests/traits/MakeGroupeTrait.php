<?php

use Faker\Factory as Faker;
use App\Models\Groupe;
use App\Repositories\GroupeRepository;

trait MakeGroupeTrait
{
    /**
     * Create fake instance of Groupe and save it in database
     *
     * @param array $groupeFields
     * @return Groupe
     */
    public function makeGroupe($groupeFields = [])
    {
        /** @var GroupeRepository $groupeRepo */
        $groupeRepo = App::make(GroupeRepository::class);
        $theme = $this->fakeGroupeData($groupeFields);
        return $groupeRepo->create($theme);
    }

    /**
     * Get fake instance of Groupe
     *
     * @param array $groupeFields
     * @return Groupe
     */
    public function fakeGroupe($groupeFields = [])
    {
        return new Groupe($this->fakeGroupeData($groupeFields));
    }

    /**
     * Get fake data of Groupe
     *
     * @param array $postFields
     * @return array
     */
    public function fakeGroupeData($groupeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nom' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $groupeFields);
    }
}
