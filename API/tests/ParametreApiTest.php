<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ParametreApiTest extends TestCase
{
    use MakeParametreTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateParametre()
    {
        $parametre = $this->fakeParametreData();
        $this->json('POST', '/api/v1/parametres', $parametre);

        $this->assertApiResponse($parametre);
    }

    /**
     * @test
     */
    public function testReadParametre()
    {
        $parametre = $this->makeParametre();
        $this->json('GET', '/api/v1/parametres/'.$parametre->id);

        $this->assertApiResponse($parametre->toArray());
    }

    /**
     * @test
     */
    public function testUpdateParametre()
    {
        $parametre = $this->makeParametre();
        $editedParametre = $this->fakeParametreData();

        $this->json('PUT', '/api/v1/parametres/'.$parametre->id, $editedParametre);

        $this->assertApiResponse($editedParametre);
    }

    /**
     * @test
     */
    public function testDeleteParametre()
    {
        $parametre = $this->makeParametre();
        $this->json('DELETE', '/api/v1/parametres/'.$parametre->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/parametres/'.$parametre->id);

        $this->assertResponseStatus(404);
    }
}
