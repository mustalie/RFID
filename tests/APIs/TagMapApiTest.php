<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TagMap;

class TagMapApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_tag_map()
    {
        $tagMap = TagMap::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/tag_maps', $tagMap
        );

        $this->assertApiResponse($tagMap);
    }

    /**
     * @test
     */
    public function test_read_tag_map()
    {
        $tagMap = TagMap::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/tag_maps/'.$tagMap->id
        );

        $this->assertApiResponse($tagMap->toArray());
    }

    /**
     * @test
     */
    public function test_update_tag_map()
    {
        $tagMap = TagMap::factory()->create();
        $editedTagMap = TagMap::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/tag_maps/'.$tagMap->id,
            $editedTagMap
        );

        $this->assertApiResponse($editedTagMap);
    }

    /**
     * @test
     */
    public function test_delete_tag_map()
    {
        $tagMap = TagMap::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/tag_maps/'.$tagMap->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/tag_maps/'.$tagMap->id
        );

        $this->response->assertStatus(404);
    }
}
