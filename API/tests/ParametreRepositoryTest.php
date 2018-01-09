<?php

use App\Models\Parametre;
use App\Repositories\ParametreRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ParametreRepositoryTest extends TestCase
{
    use MakeParametreTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ParametreRepository
     */
    protected $parametreRepo;

    public function setUp()
    {
        parent::setUp();
        $this->parametreRepo = App::make(ParametreRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateParametre()
    {
        $parametre = $this->fakeParametreData();
        $createdParametre = $this->parametreRepo->create($parametre);
        $createdParametre = $createdParametre->toArray();
        $this->assertArrayHasKey('id', $createdParametre);
        $this->assertNotNull($createdParametre['id'], 'Created Parametre must have id specified');
        $this->assertNotNull(Parametre::find($createdParametre['id']), 'Parametre with given id must be in DB');
        $this->assertModelData($parametre, $createdParametre);
    }

    /**
     * @test read
     */
    public function testReadParametre()
    {
        $parametre = $this->makeParametre();
        $dbParametre = $this->parametreRepo->find($parametre->id);
        $dbParametre = $dbParametre->toArray();
        $this->assertModelData($parametre->toArray(), $dbParametre);
    }

    /**
     * @test update
     */
    public function testUpdateParametre()
    {
        $parametre = $this->makeParametre();
        $fakeParametre = $this->fakeParametreData();
        $updatedParametre = $this->parametreRepo->update($fakeParametre, $parametre->id);
        $this->assertModelData($fakeParametre, $updatedParametre->toArray());
        $dbParametre = $this->parametreRepo->find($parametre->id);
        $this->assertModelData($fakeParametre, $dbParametre->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteParametre()
    {
        $parametre = $this->makeParametre();
        $resp = $this->parametreRepo->delete($parametre->id);
        $this->assertTrue($resp);
        $this->assertNull(Parametre::find($parametre->id), 'Parametre should not exist in DB');
    }
}
