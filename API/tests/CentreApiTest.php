<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CentreApiTest extends TestCase
{
    use MakeCentreTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCentre()
    {
        $centre = $this->fakeCentreData();
        $this->json('POST', '/api/v1/centres', $centre);

        $this->assertApiResponse($centre);
    }

    /**
     * @test
     */
    public function testReadCentre()
    {
        $centre = $this->makeCentre();
        $this->json('GET', '/api/v1/centres/'.$centre->id);

        $this->assertApiResponse($centre->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCentre()
    {
        $centre = $this->makeCentre();
        $editedCentre = $this->fakeCentreData();

        $this->json('PUT', '/api/v1/centres/'.$centre->id, $editedCentre);

        $this->assertApiResponse($editedCentre);
    }

    /**
     * @test
     */
    public function testDeleteCentre()
    {
        $centre = $this->makeCentre();
        $this->json('DELETE', '/api/v1/centres/'.$centre->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/centres/'.$centre->id);

        $this->assertResponseStatus(404);
    }
}
