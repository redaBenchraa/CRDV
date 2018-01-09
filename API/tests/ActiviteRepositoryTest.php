<?php

use App\Models\Activite;
use App\Repositories\ActiviteRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ActiviteRepositoryTest extends TestCase
{
    use MakeActiviteTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ActiviteRepository
     */
    protected $activiteRepo;

    public function setUp()
    {
        parent::setUp();
        $this->activiteRepo = App::make(ActiviteRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateActivite()
    {
        $activite = $this->fakeActiviteData();
        $createdActivite = $this->activiteRepo->create($activite);
        $createdActivite = $createdActivite->toArray();
        $this->assertArrayHasKey('id', $createdActivite);
        $this->assertNotNull($createdActivite['id'], 'Created Activite must have id specified');
        $this->assertNotNull(Activite::find($createdActivite['id']), 'Activite with given id must be in DB');
        $this->assertModelData($activite, $createdActivite);
    }

    /**
     * @test read
     */
    public function testReadActivite()
    {
        $activite = $this->makeActivite();
        $dbActivite = $this->activiteRepo->find($activite->id);
        $dbActivite = $dbActivite->toArray();
        $this->assertModelData($activite->toArray(), $dbActivite);
    }

    /**
     * @test update
     */
    public function testUpdateActivite()
    {
        $activite = $this->makeActivite();
        $fakeActivite = $this->fakeActiviteData();
        $updatedActivite = $this->activiteRepo->update($fakeActivite, $activite->id);
        $this->assertModelData($fakeActivite, $updatedActivite->toArray());
        $dbActivite = $this->activiteRepo->find($activite->id);
        $this->assertModelData($fakeActivite, $dbActivite->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteActivite()
    {
        $activite = $this->makeActivite();
        $resp = $this->activiteRepo->delete($activite->id);
        $this->assertTrue($resp);
        $this->assertNull(Activite::find($activite->id), 'Activite should not exist in DB');
    }
}
