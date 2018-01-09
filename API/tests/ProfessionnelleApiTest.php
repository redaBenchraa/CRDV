<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfessionnelleApiTest extends TestCase
{
    use MakeProfessionnelleTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateProfessionnelle()
    {
        $professionnelle = $this->fakeProfessionnelleData();
        $this->json('POST', '/api/v1/professionnelles', $professionnelle);

        $this->assertApiResponse($professionnelle);
    }

    /**
     * @test
     */
    public function testReadProfessionnelle()
    {
        $professionnelle = $this->makeProfessionnelle();
        $this->json('GET', '/api/v1/professionnelles/'.$professionnelle->id);

        $this->assertApiResponse($professionnelle->toArray());
    }

    /**
     * @test
     */
    public function testUpdateProfessionnelle()
    {
        $professionnelle = $this->makeProfessionnelle();
        $editedProfessionnelle = $this->fakeProfessionnelleData();

        $this->json('PUT', '/api/v1/professionnelles/'.$professionnelle->id, $editedProfessionnelle);

        $this->assertApiResponse($editedProfessionnelle);
    }

    /**
     * @test
     */
    public function testDeleteProfessionnelle()
    {
        $professionnelle = $this->makeProfessionnelle();
        $this->json('DELETE', '/api/v1/professionnelles/'.$professionnelle->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/professionnelles/'.$professionnelle->id);

        $this->assertResponseStatus(404);
    }
}
