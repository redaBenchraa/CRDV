<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsagerApiTest extends TestCase
{
    use MakeUsagerTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateUsager()
    {
        $usager = $this->fakeUsagerData();
        $this->json('POST', '/api/v1/usagers', $usager);

        $this->assertApiResponse($usager);
    }

    /**
     * @test
     */
    public function testReadUsager()
    {
        $usager = $this->makeUsager();
        $this->json('GET', '/api/v1/usagers/'.$usager->id);

        $this->assertApiResponse($usager->toArray());
    }

    /**
     * @test
     */
    public function testUpdateUsager()
    {
        $usager = $this->makeUsager();
        $editedUsager = $this->fakeUsagerData();

        $this->json('PUT', '/api/v1/usagers/'.$usager->id, $editedUsager);

        $this->assertApiResponse($editedUsager);
    }

    /**
     * @test
     */
    public function testDeleteUsager()
    {
        $usager = $this->makeUsager();
        $this->json('DELETE', '/api/v1/usagers/'.$usager->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/usagers/'.$usager->id);

        $this->assertResponseStatus(404);
    }
}
