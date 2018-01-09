<?php

use App\Models\Professionnelle;
use App\Repositories\ProfessionnelleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfessionnelleRepositoryTest extends TestCase
{
    use MakeProfessionnelleTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProfessionnelleRepository
     */
    protected $professionnelleRepo;

    public function setUp()
    {
        parent::setUp();
        $this->professionnelleRepo = App::make(ProfessionnelleRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateProfessionnelle()
    {
        $professionnelle = $this->fakeProfessionnelleData();
        $createdProfessionnelle = $this->professionnelleRepo->create($professionnelle);
        $createdProfessionnelle = $createdProfessionnelle->toArray();
        $this->assertArrayHasKey('id', $createdProfessionnelle);
        $this->assertNotNull($createdProfessionnelle['id'], 'Created Professionnelle must have id specified');
        $this->assertNotNull(Professionnelle::find($createdProfessionnelle['id']), 'Professionnelle with given id must be in DB');
        $this->assertModelData($professionnelle, $createdProfessionnelle);
    }

    /**
     * @test read
     */
    public function testReadProfessionnelle()
    {
        $professionnelle = $this->makeProfessionnelle();
        $dbProfessionnelle = $this->professionnelleRepo->find($professionnelle->id);
        $dbProfessionnelle = $dbProfessionnelle->toArray();
        $this->assertModelData($professionnelle->toArray(), $dbProfessionnelle);
    }

    /**
     * @test update
     */
    public function testUpdateProfessionnelle()
    {
        $professionnelle = $this->makeProfessionnelle();
        $fakeProfessionnelle = $this->fakeProfessionnelleData();
        $updatedProfessionnelle = $this->professionnelleRepo->update($fakeProfessionnelle, $professionnelle->id);
        $this->assertModelData($fakeProfessionnelle, $updatedProfessionnelle->toArray());
        $dbProfessionnelle = $this->professionnelleRepo->find($professionnelle->id);
        $this->assertModelData($fakeProfessionnelle, $dbProfessionnelle->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteProfessionnelle()
    {
        $professionnelle = $this->makeProfessionnelle();
        $resp = $this->professionnelleRepo->delete($professionnelle->id);
        $this->assertTrue($resp);
        $this->assertNull(Professionnelle::find($professionnelle->id), 'Professionnelle should not exist in DB');
    }
}
