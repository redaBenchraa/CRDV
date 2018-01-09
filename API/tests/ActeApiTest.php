<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ActeApiTest extends TestCase
{
    use MakeActeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateActe()
    {
        $acte = $this->fakeActeData();
        $this->json('POST', '/api/v1/actes', $acte);

        $this->assertApiResponse($acte);
    }

    /**
     * @test
     */
    public function testReadActe()
    {
        $acte = $this->makeActe();
        $this->json('GET', '/api/v1/actes/'.$acte->id);

        $this->assertApiResponse($acte->toArray());
    }

    /**
     * @test
     */
    public function testUpdateActe()
    {
        $acte = $this->makeActe();
        $editedActe = $this->fakeActeData();

        $this->json('PUT', '/api/v1/actes/'.$acte->id, $editedActe);

        $this->assertApiResponse($editedActe);
    }

    /**
     * @test
     */
    public function testDeleteActe()
    {
        $acte = $this->makeActe();
        $this->json('DELETE', '/api/v1/actes/'.$acte->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/actes/'.$acte->id);

        $this->assertResponseStatus(404);
    }
}
