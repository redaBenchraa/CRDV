<?php

use Faker\Factory as Faker;
use App\Models\Serafin;
use App\Repositories\SerafinRepository;

trait MakeSerafinTrait
{
    /**
     * Create fake instance of Serafin and save it in database
     *
     * @param array $serafinFields
     * @return Serafin
     */
    public function makeSerafin($serafinFields = [])
    {
        /** @var SerafinRepository $serafinRepo */
        $serafinRepo = App::make(SerafinRepository::class);
        $theme = $this->fakeSerafinData($serafinFields);
        return $serafinRepo->create($theme);
    }

    /**
     * Get fake instance of Serafin
     *
     * @param array $serafinFields
     * @return Serafin
     */
    public function fakeSerafin($serafinFields = [])
    {
        return new Serafin($this->fakeSerafinData($serafinFields));
    }

    /**
     * Get fake data of Serafin
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSerafinData($serafinFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'code' => $fake->word,
            'intitule' => $fake->word,
            'serafin_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $serafinFields);
    }
}
