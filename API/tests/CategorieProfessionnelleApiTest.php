<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategorieProfessionnelleApiTest extends TestCase
{
    use MakeCategorieProfessionnelleTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCategorieProfessionnelle()
    {
        $categorieProfessionnelle = $this->fakeCategorieProfessionnelleData();
        $this->json('POST', '/api/v1/categorieProfessionnelles', $categorieProfessionnelle);

        $this->assertApiResponse($categorieProfessionnelle);
    }

    /**
     * @test
     */
    public function testReadCategorieProfessionnelle()
    {
        $categorieProfessionnelle = $this->makeCategorieProfessionnelle();
        $this->json('GET', '/api/v1/categorieProfessionnelles/'.$categorieProfessionnelle->id);

        $this->assertApiResponse($categorieProfessionnelle->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCategorieProfessionnelle()
    {
        $categorieProfessionnelle = $this->makeCategorieProfessionnelle();
        $editedCategorieProfessionnelle = $this->fakeCategorieProfessionnelleData();

        $this->json('PUT', '/api/v1/categorieProfessionnelles/'.$categorieProfessionnelle->id, $editedCategorieProfessionnelle);

        $this->assertApiResponse($editedCategorieProfessionnelle);
    }

    /**
     * @test
     */
    public function testDeleteCategorieProfessionnelle()
    {
        $categorieProfessionnelle = $this->makeCategorieProfessionnelle();
        $this->json('DELETE', '/api/v1/categorieProfessionnelles/'.$categorieProfessionnelle->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/categorieProfessionnelles/'.$categorieProfessionnelle->id);

        $this->assertResponseStatus(404);
    }
}
