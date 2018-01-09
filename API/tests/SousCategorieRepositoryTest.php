<?php

use App\Models\sousCategorie;
use App\Repositories\sousCategorieRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class sousCategorieRepositoryTest extends TestCase
{
    use MakesousCategorieTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var sousCategorieRepository
     */
    protected $sousCategorieRepo;

    public function setUp()
    {
        parent::setUp();
        $this->sousCategorieRepo = App::make(sousCategorieRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatesousCategorie()
    {
        $sousCategorie = $this->fakesousCategorieData();
        $createdsousCategorie = $this->sousCategorieRepo->create($sousCategorie);
        $createdsousCategorie = $createdsousCategorie->toArray();
        $this->assertArrayHasKey('id', $createdsousCategorie);
        $this->assertNotNull($createdsousCategorie['id'], 'Created sousCategorie must have id specified');
        $this->assertNotNull(sousCategorie::find($createdsousCategorie['id']), 'sousCategorie with given id must be in DB');
        $this->assertModelData($sousCategorie, $createdsousCategorie);
    }

    /**
     * @test read
     */
    public function testReadsousCategorie()
    {
        $sousCategorie = $this->makesousCategorie();
        $dbsousCategorie = $this->sousCategorieRepo->find($sousCategorie->id);
        $dbsousCategorie = $dbsousCategorie->toArray();
        $this->assertModelData($sousCategorie->toArray(), $dbsousCategorie);
    }

    /**
     * @test update
     */
    public function testUpdatesousCategorie()
    {
        $sousCategorie = $this->makesousCategorie();
        $fakesousCategorie = $this->fakesousCategorieData();
        $updatedsousCategorie = $this->sousCategorieRepo->update($fakesousCategorie, $sousCategorie->id);
        $this->assertModelData($fakesousCategorie, $updatedsousCategorie->toArray());
        $dbsousCategorie = $this->sousCategorieRepo->find($sousCategorie->id);
        $this->assertModelData($fakesousCategorie, $dbsousCategorie->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletesousCategorie()
    {
        $sousCategorie = $this->makesousCategorie();
        $resp = $this->sousCategorieRepo->delete($sousCategorie->id);
        $this->assertTrue($resp);
        $this->assertNull(sousCategorie::find($sousCategorie->id), 'sousCategorie should not exist in DB');
    }
}
