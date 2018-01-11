<?php

use App\Models\SousCategorie;
use App\Repositories\SousCategorieRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SousCategorieRepositoryTest extends TestCase
{
    use MakeSousCategorieTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SousCategorieRepository
     */
    protected $sousCategorieRepo;

    public function setUp()
    {
        parent::setUp();
        $this->sousCategorieRepo = App::make(SousCategorieRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSousCategorie()
    {
        $sousCategorie = $this->fakeSousCategorieData();
        $createdSousCategorie = $this->sousCategorieRepo->create($sousCategorie);
        $createdSousCategorie = $createdSousCategorie->toArray();
        $this->assertArrayHasKey('id', $createdSousCategorie);
        $this->assertNotNull($createdSousCategorie['id'], 'Created SousCategorie must have id specified');
        $this->assertNotNull(SousCategorie::find($createdSousCategorie['id']), 'SousCategorie with given id must be in DB');
        $this->assertModelData($sousCategorie, $createdSousCategorie);
    }

    /**
     * @test read
     */
    public function testReadSousCategorie()
    {
        $sousCategorie = $this->makeSousCategorie();
        $dbSousCategorie = $this->sousCategorieRepo->find($sousCategorie->id);
        $dbSousCategorie = $dbSousCategorie->toArray();
        $this->assertModelData($sousCategorie->toArray(), $dbSousCategorie);
    }

    /**
     * @test update
     */
    public function testUpdateSousCategorie()
    {
        $sousCategorie = $this->makeSousCategorie();
        $fakeSousCategorie = $this->fakeSousCategorieData();
        $updatedSousCategorie = $this->sousCategorieRepo->update($fakeSousCategorie, $sousCategorie->id);
        $this->assertModelData($fakeSousCategorie, $updatedSousCategorie->toArray());
        $dbSousCategorie = $this->sousCategorieRepo->find($sousCategorie->id);
        $this->assertModelData($fakeSousCategorie, $dbSousCategorie->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSousCategorie()
    {
        $sousCategorie = $this->makeSousCategorie();
        $resp = $this->sousCategorieRepo->delete($sousCategorie->id);
        $this->assertTrue($resp);
        $this->assertNull(SousCategorie::find($sousCategorie->id), 'SousCategorie should not exist in DB');
    }
}
