<?php

use App\Models\Categorie;
use App\Repositories\CategorieRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategorieRepositoryTest extends TestCase
{
    use MakeCategorieTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CategorieRepository
     */
    protected $categorieRepo;

    public function setUp()
    {
        parent::setUp();
        $this->categorieRepo = App::make(CategorieRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCategorie()
    {
        $categorie = $this->fakeCategorieData();
        $createdCategorie = $this->categorieRepo->create($categorie);
        $createdCategorie = $createdCategorie->toArray();
        $this->assertArrayHasKey('id', $createdCategorie);
        $this->assertNotNull($createdCategorie['id'], 'Created Categorie must have id specified');
        $this->assertNotNull(Categorie::find($createdCategorie['id']), 'Categorie with given id must be in DB');
        $this->assertModelData($categorie, $createdCategorie);
    }

    /**
     * @test read
     */
    public function testReadCategorie()
    {
        $categorie = $this->makeCategorie();
        $dbCategorie = $this->categorieRepo->find($categorie->id);
        $dbCategorie = $dbCategorie->toArray();
        $this->assertModelData($categorie->toArray(), $dbCategorie);
    }

    /**
     * @test update
     */
    public function testUpdateCategorie()
    {
        $categorie = $this->makeCategorie();
        $fakeCategorie = $this->fakeCategorieData();
        $updatedCategorie = $this->categorieRepo->update($fakeCategorie, $categorie->id);
        $this->assertModelData($fakeCategorie, $updatedCategorie->toArray());
        $dbCategorie = $this->categorieRepo->find($categorie->id);
        $this->assertModelData($fakeCategorie, $dbCategorie->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCategorie()
    {
        $categorie = $this->makeCategorie();
        $resp = $this->categorieRepo->delete($categorie->id);
        $this->assertTrue($resp);
        $this->assertNull(Categorie::find($categorie->id), 'Categorie should not exist in DB');
    }
}
