<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategorieApiTest extends TestCase
{
    use MakeCategorieTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCategorie()
    {
        $categorie = $this->fakeCategorieData();
        $this->json('POST', '/api/v1/categories', $categorie);

        $this->assertApiResponse($categorie);
    }

    /**
     * @test
     */
    public function testReadCategorie()
    {
        $categorie = $this->makeCategorie();
        $this->json('GET', '/api/v1/categories/'.$categorie->id);

        $this->assertApiResponse($categorie->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCategorie()
    {
        $categorie = $this->makeCategorie();
        $editedCategorie = $this->fakeCategorieData();

        $this->json('PUT', '/api/v1/categories/'.$categorie->id, $editedCategorie);

        $this->assertApiResponse($editedCategorie);
    }

    /**
     * @test
     */
    public function testDeleteCategorie()
    {
        $categorie = $this->makeCategorie();
        $this->json('DELETE', '/api/v1/categories/'.$categorie->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/categories/'.$categorie->id);

        $this->assertResponseStatus(404);
    }
}
