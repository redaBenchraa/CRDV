<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SerafinApiTest extends TestCase
{
    use MakeSerafinTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSerafin()
    {
        $serafin = $this->fakeSerafinData();
        $this->json('POST', '/api/v1/serafins', $serafin);

        $this->assertApiResponse($serafin);
    }

    /**
     * @test
     */
    public function testReadSerafin()
    {
        $serafin = $this->makeSerafin();
        $this->json('GET', '/api/v1/serafins/'.$serafin->id);

        $this->assertApiResponse($serafin->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSerafin()
    {
        $serafin = $this->makeSerafin();
        $editedSerafin = $this->fakeSerafinData();

        $this->json('PUT', '/api/v1/serafins/'.$serafin->id, $editedSerafin);

        $this->assertApiResponse($editedSerafin);
    }

    /**
     * @test
     */
    public function testDeleteSerafin()
    {
        $serafin = $this->makeSerafin();
        $this->json('DELETE', '/api/v1/serafins/'.$serafin->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/serafins/'.$serafin->id);

        $this->assertResponseStatus(404);
    }
}
