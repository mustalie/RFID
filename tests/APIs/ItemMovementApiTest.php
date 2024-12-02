<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ItemMovement;

class ItemMovementApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_item_movement()
    {
        $itemMovement = ItemMovement::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/item_movements', $itemMovement
        );

        $this->assertApiResponse($itemMovement);
    }

    /**
     * @test
     */
    public function test_read_item_movement()
    {
        $itemMovement = ItemMovement::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/item_movements/'.$itemMovement->id
        );

        $this->assertApiResponse($itemMovement->toArray());
    }

    /**
     * @test
     */
    public function test_update_item_movement()
    {
        $itemMovement = ItemMovement::factory()->create();
        $editedItemMovement = ItemMovement::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/item_movements/'.$itemMovement->id,
            $editedItemMovement
        );

        $this->assertApiResponse($editedItemMovement);
    }

    /**
     * @test
     */
    public function test_delete_item_movement()
    {
        $itemMovement = ItemMovement::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/item_movements/'.$itemMovement->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/item_movements/'.$itemMovement->id
        );

        $this->response->assertStatus(404);
    }
}
