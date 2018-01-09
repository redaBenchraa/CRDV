<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdaptationApiTest extends TestCase
{
    use MakeAdaptationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateAdaptation()
    {
        $adaptation = $this->fakeAdaptationData();
        $this->json('POST', '/api/v1/adaptations', $adaptation);

        $this->assertApiResponse($adaptation);
    }

    /**
     * @test
     */
    public function testReadAdaptation()
    {
        $adaptation = $this->makeAdaptation();
        $this->json('GET', '/api/v1/adaptations/'.$adaptation->id);

        $this->assertApiResponse($adaptation->toArray());
    }

    /**
     * @test
     */
    public function testUpdateAdaptation()
    {
        $adaptation = $this->makeAdaptation();
        $editedAdaptation = $this->fakeAdaptationData();

        $this->json('PUT', '/api/v1/adaptations/'.$adaptation->id, $editedAdaptation);

        $this->assertApiResponse($editedAdaptation);
    }

    /**
     * @test
     */
    public function testDeleteAdaptation()
    {
        $adaptation = $this->makeAdaptation();
        $this->json('DELETE', '/api/v1/adaptations/'.$adaptation->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/adaptations/'.$adaptation->id);

        $this->assertResponseStatus(404);
    }
}
