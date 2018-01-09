<?php

use App\Models\EmploiDuTemps;
use App\Repositories\EmploiDuTempsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmploiDuTempsRepositoryTest extends TestCase
{
    use MakeEmploiDuTempsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var EmploiDuTempsRepository
     */
    protected $emploiDuTempsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->emploiDuTempsRepo = App::make(EmploiDuTempsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateEmploiDuTemps()
    {
        $emploiDuTemps = $this->fakeEmploiDuTempsData();
        $createdEmploiDuTemps = $this->emploiDuTempsRepo->create($emploiDuTemps);
        $createdEmploiDuTemps = $createdEmploiDuTemps->toArray();
        $this->assertArrayHasKey('id', $createdEmploiDuTemps);
        $this->assertNotNull($createdEmploiDuTemps['id'], 'Created EmploiDuTemps must have id specified');
        $this->assertNotNull(EmploiDuTemps::find($createdEmploiDuTemps['id']), 'EmploiDuTemps with given id must be in DB');
        $this->assertModelData($emploiDuTemps, $createdEmploiDuTemps);
    }

    /**
     * @test read
     */
    public function testReadEmploiDuTemps()
    {
        $emploiDuTemps = $this->makeEmploiDuTemps();
        $dbEmploiDuTemps = $this->emploiDuTempsRepo->find($emploiDuTemps->id);
        $dbEmploiDuTemps = $dbEmploiDuTemps->toArray();
        $this->assertModelData($emploiDuTemps->toArray(), $dbEmploiDuTemps);
    }

    /**
     * @test update
     */
    public function testUpdateEmploiDuTemps()
    {
        $emploiDuTemps = $this->makeEmploiDuTemps();
        $fakeEmploiDuTemps = $this->fakeEmploiDuTempsData();
        $updatedEmploiDuTemps = $this->emploiDuTempsRepo->update($fakeEmploiDuTemps, $emploiDuTemps->id);
        $this->assertModelData($fakeEmploiDuTemps, $updatedEmploiDuTemps->toArray());
        $dbEmploiDuTemps = $this->emploiDuTempsRepo->find($emploiDuTemps->id);
        $this->assertModelData($fakeEmploiDuTemps, $dbEmploiDuTemps->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteEmploiDuTemps()
    {
        $emploiDuTemps = $this->makeEmploiDuTemps();
        $resp = $this->emploiDuTempsRepo->delete($emploiDuTemps->id);
        $this->assertTrue($resp);
        $this->assertNull(EmploiDuTemps::find($emploiDuTemps->id), 'EmploiDuTemps should not exist in DB');
    }
}
