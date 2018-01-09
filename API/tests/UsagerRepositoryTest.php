<?php

use App\Models\Usager;
use App\Repositories\UsagerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsagerRepositoryTest extends TestCase
{
    use MakeUsagerTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var UsagerRepository
     */
    protected $usagerRepo;

    public function setUp()
    {
        parent::setUp();
        $this->usagerRepo = App::make(UsagerRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateUsager()
    {
        $usager = $this->fakeUsagerData();
        $createdUsager = $this->usagerRepo->create($usager);
        $createdUsager = $createdUsager->toArray();
        $this->assertArrayHasKey('id', $createdUsager);
        $this->assertNotNull($createdUsager['id'], 'Created Usager must have id specified');
        $this->assertNotNull(Usager::find($createdUsager['id']), 'Usager with given id must be in DB');
        $this->assertModelData($usager, $createdUsager);
    }

    /**
     * @test read
     */
    public function testReadUsager()
    {
        $usager = $this->makeUsager();
        $dbUsager = $this->usagerRepo->find($usager->id);
        $dbUsager = $dbUsager->toArray();
        $this->assertModelData($usager->toArray(), $dbUsager);
    }

    /**
     * @test update
     */
    public function testUpdateUsager()
    {
        $usager = $this->makeUsager();
        $fakeUsager = $this->fakeUsagerData();
        $updatedUsager = $this->usagerRepo->update($fakeUsager, $usager->id);
        $this->assertModelData($fakeUsager, $updatedUsager->toArray());
        $dbUsager = $this->usagerRepo->find($usager->id);
        $this->assertModelData($fakeUsager, $dbUsager->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteUsager()
    {
        $usager = $this->makeUsager();
        $resp = $this->usagerRepo->delete($usager->id);
        $this->assertTrue($resp);
        $this->assertNull(Usager::find($usager->id), 'Usager should not exist in DB');
    }
}
