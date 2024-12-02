<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\InventoryRoom;

class InventoryRoomApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_inventory_room()
    {
        $inventoryRoom = InventoryRoom::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/inventory_rooms', $inventoryRoom
        );

        $this->assertApiResponse($inventoryRoom);
    }

    /**
     * @test
     */
    public function test_read_inventory_room()
    {
        $inventoryRoom = InventoryRoom::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/inventory_rooms/'.$inventoryRoom->id
        );

        $this->assertApiResponse($inventoryRoom->toArray());
    }

    /**
     * @test
     */
    public function test_update_inventory_room()
    {
        $inventoryRoom = InventoryRoom::factory()->create();
        $editedInventoryRoom = InventoryRoom::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/inventory_rooms/'.$inventoryRoom->id,
            $editedInventoryRoom
        );

        $this->assertApiResponse($editedInventoryRoom);
    }

    /**
     * @test
     */
    public function test_delete_inventory_room()
    {
        $inventoryRoom = InventoryRoom::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/inventory_rooms/'.$inventoryRoom->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/inventory_rooms/'.$inventoryRoom->id
        );

        $this->response->assertStatus(404);
    }
}
