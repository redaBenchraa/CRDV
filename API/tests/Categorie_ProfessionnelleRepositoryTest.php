<?php

use App\Models\Categorie_Professionnelle;
use App\Repositories\Categorie_ProfessionnelleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Categorie_ProfessionnelleRepositoryTest extends TestCase
{
    use MakeCategorie_ProfessionnelleTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var Categorie_ProfessionnelleRepository
     */
    protected $categorieProfessionnelleRepo;

    public function setUp()
    {
        parent::setUp();
        $this->categorieProfessionnelleRepo = App::make(Categorie_ProfessionnelleRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCategorie_Professionnelle()
    {
        $categorieProfessionnelle = $this->fakeCategorie_ProfessionnelleData();
        $createdCategorie_Professionnelle = $this->categorieProfessionnelleRepo->create($categorieProfessionnelle);
        $createdCategorie_Professionnelle = $createdCategorie_Professionnelle->toArray();
        $this->assertArrayHasKey('id', $createdCategorie_Professionnelle);
        $this->assertNotNull($createdCategorie_Professionnelle['id'], 'Created Categorie_Professionnelle must have id specified');
        $this->assertNotNull(Categorie_Professionnelle::find($createdCategorie_Professionnelle['id']), 'Categorie_Professionnelle with given id must be in DB');
        $this->assertModelData($categorieProfessionnelle, $createdCategorie_Professionnelle);
    }

    /**
     * @test read
     */
    public function testReadCategorie_Professionnelle()
    {
        $categorieProfessionnelle = $this->makeCategorie_Professionnelle();
        $dbCategorie_Professionnelle = $this->categorieProfessionnelleRepo->find($categorieProfessionnelle->id);
        $dbCategorie_Professionnelle = $dbCategorie_Professionnelle->toArray();
        $this->assertModelData($categorieProfessionnelle->toArray(), $dbCategorie_Professionnelle);
    }

    /**
     * @test update
     */
    public function testUpdateCategorie_Professionnelle()
    {
        $categorieProfessionnelle = $this->makeCategorie_Professionnelle();
        $fakeCategorie_Professionnelle = $this->fakeCategorie_ProfessionnelleData();
        $updatedCategorie_Professionnelle = $this->categorieProfessionnelleRepo->update($fakeCategorie_Professionnelle, $categorieProfessionnelle->id);
        $this->assertModelData($fakeCategorie_Professionnelle, $updatedCategorie_Professionnelle->toArray());
        $dbCategorie_Professionnelle = $this->categorieProfessionnelleRepo->find($categorieProfessionnelle->id);
        $this->assertModelData($fakeCategorie_Professionnelle, $dbCategorie_Professionnelle->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCategorie_Professionnelle()
    {
        $categorieProfessionnelle = $this->makeCategorie_Professionnelle();
        $resp = $this->categorieProfessionnelleRepo->delete($categorieProfessionnelle->id);
        $this->assertTrue($resp);
        $this->assertNull(Categorie_Professionnelle::find($categorieProfessionnelle->id), 'Categorie_Professionnelle should not exist in DB');
    }
}
