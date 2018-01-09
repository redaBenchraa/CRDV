<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ActiviteApiTest extends TestCase
{
    use MakeActiviteTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateActivite()
    {
        $activite = $this->fakeActiviteData();
        $this->json('POST', '/api/v1/activites', $activite);

        $this->assertApiResponse($activite);
    }

    /**
     * @test
     */
    public function testReadActivite()
    {
        $activite = $this->makeActivite();
        $this->json('GET', '/api/v1/activites/'.$activite->id);

        $this->assertApiResponse($activite->toArray());
    }

    /**
     * @test
     */
    public function testUpdateActivite()
    {
        $activite = $this->makeActivite();
        $editedActivite = $this->fakeActiviteData();

        $this->json('PUT', '/api/v1/activites/'.$activite->id, $editedActivite);

        $this->assertApiResponse($editedActivite);
    }

    /**
     * @test
     */
    public function testDeleteActivite()
    {
        $activite = $this->makeActivite();
        $this->json('DELETE', '/api/v1/activites/'.$activite->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/activites/'.$activite->id);

        $this->assertResponseStatus(404);
    }
}
