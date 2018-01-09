<?php

use App\Models\Adaptation;
use App\Repositories\AdaptationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdaptationRepositoryTest extends TestCase
{
    use MakeAdaptationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var AdaptationRepository
     */
    protected $adaptationRepo;

    public function setUp()
    {
        parent::setUp();
        $this->adaptationRepo = App::make(AdaptationRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateAdaptation()
    {
        $adaptation = $this->fakeAdaptationData();
        $createdAdaptation = $this->adaptationRepo->create($adaptation);
        $createdAdaptation = $createdAdaptation->toArray();
        $this->assertArrayHasKey('id', $createdAdaptation);
        $this->assertNotNull($createdAdaptation['id'], 'Created Adaptation must have id specified');
        $this->assertNotNull(Adaptation::find($createdAdaptation['id']), 'Adaptation with given id must be in DB');
        $this->assertModelData($adaptation, $createdAdaptation);
    }

    /**
     * @test read
     */
    public function testReadAdaptation()
    {
        $adaptation = $this->makeAdaptation();
        $dbAdaptation = $this->adaptationRepo->find($adaptation->id);
        $dbAdaptation = $dbAdaptation->toArray();
        $this->assertModelData($adaptation->toArray(), $dbAdaptation);
    }

    /**
     * @test update
     */
    public function testUpdateAdaptation()
    {
        $adaptation = $this->makeAdaptation();
        $fakeAdaptation = $this->fakeAdaptationData();
        $updatedAdaptation = $this->adaptationRepo->update($fakeAdaptation, $adaptation->id);
        $this->assertModelData($fakeAdaptation, $updatedAdaptation->toArray());
        $dbAdaptation = $this->adaptationRepo->find($adaptation->id);
        $this->assertModelData($fakeAdaptation, $dbAdaptation->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteAdaptation()
    {
        $adaptation = $this->makeAdaptation();
        $resp = $this->adaptationRepo->delete($adaptation->id);
        $this->assertTrue($resp);
        $this->assertNull(Adaptation::find($adaptation->id), 'Adaptation should not exist in DB');
    }
}
