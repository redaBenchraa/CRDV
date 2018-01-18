<?php

use App\Models\Serafin;
use App\Repositories\SerafinRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SerafinRepositoryTest extends TestCase
{
    use MakeSerafinTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SerafinRepository
     */
    protected $serafinRepo;

    public function setUp()
    {
        parent::setUp();
        $this->serafinRepo = App::make(SerafinRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSerafin()
    {
        $serafin = $this->fakeSerafinData();
        $createdSerafin = $this->serafinRepo->create($serafin);
        $createdSerafin = $createdSerafin->toArray();
        $this->assertArrayHasKey('id', $createdSerafin);
        $this->assertNotNull($createdSerafin['id'], 'Created Serafin must have id specified');
        $this->assertNotNull(Serafin::find($createdSerafin['id']), 'Serafin with given id must be in DB');
        $this->assertModelData($serafin, $createdSerafin);
    }

    /**
     * @test read
     */
    public function testReadSerafin()
    {
        $serafin = $this->makeSerafin();
        $dbSerafin = $this->serafinRepo->find($serafin->id);
        $dbSerafin = $dbSerafin->toArray();
        $this->assertModelData($serafin->toArray(), $dbSerafin);
    }

    /**
     * @test update
     */
    public function testUpdateSerafin()
    {
        $serafin = $this->makeSerafin();
        $fakeSerafin = $this->fakeSerafinData();
        $updatedSerafin = $this->serafinRepo->update($fakeSerafin, $serafin->id);
        $this->assertModelData($fakeSerafin, $updatedSerafin->toArray());
        $dbSerafin = $this->serafinRepo->find($serafin->id);
        $this->assertModelData($fakeSerafin, $dbSerafin->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSerafin()
    {
        $serafin = $this->makeSerafin();
        $resp = $this->serafinRepo->delete($serafin->id);
        $this->assertTrue($resp);
        $this->assertNull(Serafin::find($serafin->id), 'Serafin should not exist in DB');
    }
}
