<?php

use App\Models\CategorieProfessionnelle;
use App\Repositories\CategorieProfessionnelleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategorieProfessionnelleRepositoryTest extends TestCase
{
    use MakeCategorieProfessionnelleTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CategorieProfessionnelleRepository
     */
    protected $categorieProfessionnelleRepo;

    public function setUp()
    {
        parent::setUp();
        $this->categorieProfessionnelleRepo = App::make(CategorieProfessionnelleRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCategorieProfessionnelle()
    {
        $categorieProfessionnelle = $this->fakeCategorieProfessionnelleData();
        $createdCategorieProfessionnelle = $this->categorieProfessionnelleRepo->create($categorieProfessionnelle);
        $createdCategorieProfessionnelle = $createdCategorieProfessionnelle->toArray();
        $this->assertArrayHasKey('id', $createdCategorieProfessionnelle);
        $this->assertNotNull($createdCategorieProfessionnelle['id'], 'Created CategorieProfessionnelle must have id specified');
        $this->assertNotNull(CategorieProfessionnelle::find($createdCategorieProfessionnelle['id']), 'CategorieProfessionnelle with given id must be in DB');
        $this->assertModelData($categorieProfessionnelle, $createdCategorieProfessionnelle);
    }

    /**
     * @test read
     */
    public function testReadCategorieProfessionnelle()
    {
        $categorieProfessionnelle = $this->makeCategorieProfessionnelle();
        $dbCategorieProfessionnelle = $this->categorieProfessionnelleRepo->find($categorieProfessionnelle->id);
        $dbCategorieProfessionnelle = $dbCategorieProfessionnelle->toArray();
        $this->assertModelData($categorieProfessionnelle->toArray(), $dbCategorieProfessionnelle);
    }

    /**
     * @test update
     */
    public function testUpdateCategorieProfessionnelle()
    {
        $categorieProfessionnelle = $this->makeCategorieProfessionnelle();
        $fakeCategorieProfessionnelle = $this->fakeCategorieProfessionnelleData();
        $updatedCategorieProfessionnelle = $this->categorieProfessionnelleRepo->update($fakeCategorieProfessionnelle, $categorieProfessionnelle->id);
        $this->assertModelData($fakeCategorieProfessionnelle, $updatedCategorieProfessionnelle->toArray());
        $dbCategorieProfessionnelle = $this->categorieProfessionnelleRepo->find($categorieProfessionnelle->id);
        $this->assertModelData($fakeCategorieProfessionnelle, $dbCategorieProfessionnelle->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCategorieProfessionnelle()
    {
        $categorieProfessionnelle = $this->makeCategorieProfessionnelle();
        $resp = $this->categorieProfessionnelleRepo->delete($categorieProfessionnelle->id);
        $this->assertTrue($resp);
        $this->assertNull(CategorieProfessionnelle::find($categorieProfessionnelle->id), 'CategorieProfessionnelle should not exist in DB');
    }
}
