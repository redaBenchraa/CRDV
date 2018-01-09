<?php

use App\Models\Centre;
use App\Repositories\CentreRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CentreRepositoryTest extends TestCase
{
    use MakeCentreTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CentreRepository
     */
    protected $centreRepo;

    public function setUp()
    {
        parent::setUp();
        $this->centreRepo = App::make(CentreRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCentre()
    {
        $centre = $this->fakeCentreData();
        $createdCentre = $this->centreRepo->create($centre);
        $createdCentre = $createdCentre->toArray();
        $this->assertArrayHasKey('id', $createdCentre);
        $this->assertNotNull($createdCentre['id'], 'Created Centre must have id specified');
        $this->assertNotNull(Centre::find($createdCentre['id']), 'Centre with given id must be in DB');
        $this->assertModelData($centre, $createdCentre);
    }

    /**
     * @test read
     */
    public function testReadCentre()
    {
        $centre = $this->makeCentre();
        $dbCentre = $this->centreRepo->find($centre->id);
        $dbCentre = $dbCentre->toArray();
        $this->assertModelData($centre->toArray(), $dbCentre);
    }

    /**
     * @test update
     */
    public function testUpdateCentre()
    {
        $centre = $this->makeCentre();
        $fakeCentre = $this->fakeCentreData();
        $updatedCentre = $this->centreRepo->update($fakeCentre, $centre->id);
        $this->assertModelData($fakeCentre, $updatedCentre->toArray());
        $dbCentre = $this->centreRepo->find($centre->id);
        $this->assertModelData($fakeCentre, $dbCentre->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCentre()
    {
        $centre = $this->makeCentre();
        $resp = $this->centreRepo->delete($centre->id);
        $this->assertTrue($resp);
        $this->assertNull(Centre::find($centre->id), 'Centre should not exist in DB');
    }
}
