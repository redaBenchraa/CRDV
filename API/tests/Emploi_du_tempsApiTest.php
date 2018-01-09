<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Emploi_du_tempsApiTest extends TestCase
{
    use MakeEmploi_du_tempsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateEmploi_du_temps()
    {
        $emploiDuTemps = $this->fakeEmploi_du_tempsData();
        $this->json('POST', '/api/v1/emploiDuTemps', $emploiDuTemps);

        $this->assertApiResponse($emploiDuTemps);
    }

    /**
     * @test
     */
    public function testReadEmploi_du_temps()
    {
        $emploiDuTemps = $this->makeEmploi_du_temps();
        $this->json('GET', '/api/v1/emploiDuTemps/'.$emploiDuTemps->id);

        $this->assertApiResponse($emploiDuTemps->toArray());
    }

    /**
     * @test
     */
    public function testUpdateEmploi_du_temps()
    {
        $emploiDuTemps = $this->makeEmploi_du_temps();
        $editedEmploi_du_temps = $this->fakeEmploi_du_tempsData();

        $this->json('PUT', '/api/v1/emploiDuTemps/'.$emploiDuTemps->id, $editedEmploi_du_temps);

        $this->assertApiResponse($editedEmploi_du_temps);
    }

    /**
     * @test
     */
    public function testDeleteEmploi_du_temps()
    {
        $emploiDuTemps = $this->makeEmploi_du_temps();
        $this->json('DELETE', '/api/v1/emploiDuTemps/'.$emploiDuTemps->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/emploiDuTemps/'.$emploiDuTemps->id);

        $this->assertResponseStatus(404);
    }
}
