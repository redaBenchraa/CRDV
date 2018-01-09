<?php

use App\Models\Acte;
use App\Repositories\ActeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ActeRepositoryTest extends TestCase
{
    use MakeActeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ActeRepository
     */
    protected $acteRepo;

    public function setUp()
    {
        parent::setUp();
        $this->acteRepo = App::make(ActeRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateActe()
    {
        $acte = $this->fakeActeData();
        $createdActe = $this->acteRepo->create($acte);
        $createdActe = $createdActe->toArray();
        $this->assertArrayHasKey('id', $createdActe);
        $this->assertNotNull($createdActe['id'], 'Created Acte must have id specified');
        $this->assertNotNull(Acte::find($createdActe['id']), 'Acte with given id must be in DB');
        $this->assertModelData($acte, $createdActe);
    }

    /**
     * @test read
     */
    public function testReadActe()
    {
        $acte = $this->makeActe();
        $dbActe = $this->acteRepo->find($acte->id);
        $dbActe = $dbActe->toArray();
        $this->assertModelData($acte->toArray(), $dbActe);
    }

    /**
     * @test update
     */
    public function testUpdateActe()
    {
        $acte = $this->makeActe();
        $fakeActe = $this->fakeActeData();
        $updatedActe = $this->acteRepo->update($fakeActe, $acte->id);
        $this->assertModelData($fakeActe, $updatedActe->toArray());
        $dbActe = $this->acteRepo->find($acte->id);
        $this->assertModelData($fakeActe, $dbActe->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteActe()
    {
        $acte = $this->makeActe();
        $resp = $this->acteRepo->delete($acte->id);
        $this->assertTrue($resp);
        $this->assertNull(Acte::find($acte->id), 'Acte should not exist in DB');
    }
}
