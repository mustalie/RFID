<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\InventoryGroup;

class InventoryGroupApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_inventory_group()
    {
        $inventoryGroup = InventoryGroup::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/inventory_groups', $inventoryGroup
        );

        $this->assertApiResponse($inventoryGroup);
    }

    /**
     * @test
     */
    public function test_read_inventory_group()
    {
        $inventoryGroup = InventoryGroup::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/inventory_groups/'.$inventoryGroup->id
        );

        $this->assertApiResponse($inventoryGroup->toArray());
    }

    /**
     * @test
     */
    public function test_update_inventory_group()
    {
        $inventoryGroup = InventoryGroup::factory()->create();
        $editedInventoryGroup = InventoryGroup::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/inventory_groups/'.$inventoryGroup->id,
            $editedInventoryGroup
        );

        $this->assertApiResponse($editedInventoryGroup);
    }

    /**
     * @test
     */
    public function test_delete_inventory_group()
    {
        $inventoryGroup = InventoryGroup::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/inventory_groups/'.$inventoryGroup->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/inventory_groups/'.$inventoryGroup->id
        );

        $this->response->assertStatus(404);
    }
}
