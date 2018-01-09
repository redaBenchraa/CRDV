<?php

use App\Models\Emploi_du_temps;
use App\Repositories\Emploi_du_tempsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Emploi_du_tempsRepositoryTest extends TestCase
{
    use MakeEmploi_du_tempsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var Emploi_du_tempsRepository
     */
    protected $emploiDuTempsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->emploiDuTempsRepo = App::make(Emploi_du_tempsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateEmploi_du_temps()
    {
        $emploiDuTemps = $this->fakeEmploi_du_tempsData();
        $createdEmploi_du_temps = $this->emploiDuTempsRepo->create($emploiDuTemps);
        $createdEmploi_du_temps = $createdEmploi_du_temps->toArray();
        $this->assertArrayHasKey('id', $createdEmploi_du_temps);
        $this->assertNotNull($createdEmploi_du_temps['id'], 'Created Emploi_du_temps must have id specified');
        $this->assertNotNull(Emploi_du_temps::find($createdEmploi_du_temps['id']), 'Emploi_du_temps with given id must be in DB');
        $this->assertModelData($emploiDuTemps, $createdEmploi_du_temps);
    }

    /**
     * @test read
     */
    public function testReadEmploi_du_temps()
    {
        $emploiDuTemps = $this->makeEmploi_du_temps();
        $dbEmploi_du_temps = $this->emploiDuTempsRepo->find($emploiDuTemps->id);
        $dbEmploi_du_temps = $dbEmploi_du_temps->toArray();
        $this->assertModelData($emploiDuTemps->toArray(), $dbEmploi_du_temps);
    }

    /**
     * @test update
     */
    public function testUpdateEmploi_du_temps()
    {
        $emploiDuTemps = $this->makeEmploi_du_temps();
        $fakeEmploi_du_temps = $this->fakeEmploi_du_tempsData();
        $updatedEmploi_du_temps = $this->emploiDuTempsRepo->update($fakeEmploi_du_temps, $emploiDuTemps->id);
        $this->assertModelData($fakeEmploi_du_temps, $updatedEmploi_du_temps->toArray());
        $dbEmploi_du_temps = $this->emploiDuTempsRepo->find($emploiDuTemps->id);
        $this->assertModelData($fakeEmploi_du_temps, $dbEmploi_du_temps->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteEmploi_du_temps()
    {
        $emploiDuTemps = $this->makeEmploi_du_temps();
        $resp = $this->emploiDuTempsRepo->delete($emploiDuTemps->id);
        $this->assertTrue($resp);
        $this->assertNull(Emploi_du_temps::find($emploiDuTemps->id), 'Emploi_du_temps should not exist in DB');
    }
}
