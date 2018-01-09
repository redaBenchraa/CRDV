<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmploiDuTempsApiTest extends TestCase
{
    use MakeEmploiDuTempsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateEmploiDuTemps()
    {
        $emploiDuTemps = $this->fakeEmploiDuTempsData();
        $this->json('POST', '/api/v1/emploiDuTemps', $emploiDuTemps);

        $this->assertApiResponse($emploiDuTemps);
    }

    /**
     * @test
     */
    public function testReadEmploiDuTemps()
    {
        $emploiDuTemps = $this->makeEmploiDuTemps();
        $this->json('GET', '/api/v1/emploiDuTemps/'.$emploiDuTemps->id);

        $this->assertApiResponse($emploiDuTemps->toArray());
    }

    /**
     * @test
     */
    public function testUpdateEmploiDuTemps()
    {
        $emploiDuTemps = $this->makeEmploiDuTemps();
        $editedEmploiDuTemps = $this->fakeEmploiDuTempsData();

        $this->json('PUT', '/api/v1/emploiDuTemps/'.$emploiDuTemps->id, $editedEmploiDuTemps);

        $this->assertApiResponse($editedEmploiDuTemps);
    }

    /**
     * @test
     */
    public function testDeleteEmploiDuTemps()
    {
        $emploiDuTemps = $this->makeEmploiDuTemps();
        $this->json('DELETE', '/api/v1/emploiDuTemps/'.$emploiDuTemps->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/emploiDuTemps/'.$emploiDuTemps->id);

        $this->assertResponseStatus(404);
    }
}
