<?php

use App\Models\Groupe;
use App\Repositories\GroupeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GroupeRepositoryTest extends TestCase
{
    use MakeGroupeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var GroupeRepository
     */
    protected $groupeRepo;

    public function setUp()
    {
        parent::setUp();
        $this->groupeRepo = App::make(GroupeRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateGroupe()
    {
        $groupe = $this->fakeGroupeData();
        $createdGroupe = $this->groupeRepo->create($groupe);
        $createdGroupe = $createdGroupe->toArray();
        $this->assertArrayHasKey('id', $createdGroupe);
        $this->assertNotNull($createdGroupe['id'], 'Created Groupe must have id specified');
        $this->assertNotNull(Groupe::find($createdGroupe['id']), 'Groupe with given id must be in DB');
        $this->assertModelData($groupe, $createdGroupe);
    }

    /**
     * @test read
     */
    public function testReadGroupe()
    {
        $groupe = $this->makeGroupe();
        $dbGroupe = $this->groupeRepo->find($groupe->id);
        $dbGroupe = $dbGroupe->toArray();
        $this->assertModelData($groupe->toArray(), $dbGroupe);
    }

    /**
     * @test update
     */
    public function testUpdateGroupe()
    {
        $groupe = $this->makeGroupe();
        $fakeGroupe = $this->fakeGroupeData();
        $updatedGroupe = $this->groupeRepo->update($fakeGroupe, $groupe->id);
        $this->assertModelData($fakeGroupe, $updatedGroupe->toArray());
        $dbGroupe = $this->groupeRepo->find($groupe->id);
        $this->assertModelData($fakeGroupe, $dbGroupe->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteGroupe()
    {
        $groupe = $this->makeGroupe();
        $resp = $this->groupeRepo->delete($groupe->id);
        $this->assertTrue($resp);
        $this->assertNull(Groupe::find($groupe->id), 'Groupe should not exist in DB');
    }
}
