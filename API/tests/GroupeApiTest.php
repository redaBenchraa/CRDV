<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GroupeApiTest extends TestCase
{
    use MakeGroupeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateGroupe()
    {
        $groupe = $this->fakeGroupeData();
        $this->json('POST', '/api/v1/groupes', $groupe);

        $this->assertApiResponse($groupe);
    }

    /**
     * @test
     */
    public function testReadGroupe()
    {
        $groupe = $this->makeGroupe();
        $this->json('GET', '/api/v1/groupes/'.$groupe->id);

        $this->assertApiResponse($groupe->toArray());
    }

    /**
     * @test
     */
    public function testUpdateGroupe()
    {
        $groupe = $this->makeGroupe();
        $editedGroupe = $this->fakeGroupeData();

        $this->json('PUT', '/api/v1/groupes/'.$groupe->id, $editedGroupe);

        $this->assertApiResponse($editedGroupe);
    }

    /**
     * @test
     */
    public function testDeleteGroupe()
    {
        $groupe = $this->makeGroupe();
        $this->json('DELETE', '/api/v1/groupes/'.$groupe->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/groupes/'.$groupe->id);

        $this->assertResponseStatus(404);
    }
}
