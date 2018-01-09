<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Categorie_ProfessionnelleApiTest extends TestCase
{
    use MakeCategorie_ProfessionnelleTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCategorie_Professionnelle()
    {
        $categorieProfessionnelle = $this->fakeCategorie_ProfessionnelleData();
        $this->json('POST', '/api/v1/categorieProfessionnelles', $categorieProfessionnelle);

        $this->assertApiResponse($categorieProfessionnelle);
    }

    /**
     * @test
     */
    public function testReadCategorie_Professionnelle()
    {
        $categorieProfessionnelle = $this->makeCategorie_Professionnelle();
        $this->json('GET', '/api/v1/categorieProfessionnelles/'.$categorieProfessionnelle->id);

        $this->assertApiResponse($categorieProfessionnelle->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCategorie_Professionnelle()
    {
        $categorieProfessionnelle = $this->makeCategorie_Professionnelle();
        $editedCategorie_Professionnelle = $this->fakeCategorie_ProfessionnelleData();

        $this->json('PUT', '/api/v1/categorieProfessionnelles/'.$categorieProfessionnelle->id, $editedCategorie_Professionnelle);

        $this->assertApiResponse($editedCategorie_Professionnelle);
    }

    /**
     * @test
     */
    public function testDeleteCategorie_Professionnelle()
    {
        $categorieProfessionnelle = $this->makeCategorie_Professionnelle();
        $this->json('DELETE', '/api/v1/categorieProfessionnelles/'.$categorieProfessionnelle->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/categorieProfessionnelles/'.$categorieProfessionnelle->id);

        $this->assertResponseStatus(404);
    }
}
