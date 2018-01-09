<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class sousCategorieApiTest extends TestCase
{
    use MakesousCategorieTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatesousCategorie()
    {
        $sousCategorie = $this->fakesousCategorieData();
        $this->json('POST', '/api/v1/sousCategories', $sousCategorie);

        $this->assertApiResponse($sousCategorie);
    }

    /**
     * @test
     */
    public function testReadsousCategorie()
    {
        $sousCategorie = $this->makesousCategorie();
        $this->json('GET', '/api/v1/sousCategories/'.$sousCategorie->id);

        $this->assertApiResponse($sousCategorie->toArray());
    }

    /**
     * @test
     */
    public function testUpdatesousCategorie()
    {
        $sousCategorie = $this->makesousCategorie();
        $editedsousCategorie = $this->fakesousCategorieData();

        $this->json('PUT', '/api/v1/sousCategories/'.$sousCategorie->id, $editedsousCategorie);

        $this->assertApiResponse($editedsousCategorie);
    }

    /**
     * @test
     */
    public function testDeletesousCategorie()
    {
        $sousCategorie = $this->makesousCategorie();
        $this->json('DELETE', '/api/v1/sousCategories/'.$sousCategorie->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/sousCategories/'.$sousCategorie->id);

        $this->assertResponseStatus(404);
    }
}
