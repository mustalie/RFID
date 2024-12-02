<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\InventoryDetail;

class InventoryDetailApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_inventory_detail()
    {
        $inventoryDetail = InventoryDetail::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/inventory_details', $inventoryDetail
        );

        $this->assertApiResponse($inventoryDetail);
    }

    /**
     * @test
     */
    public function test_read_inventory_detail()
    {
        $inventoryDetail = InventoryDetail::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/inventory_details/'.$inventoryDetail->id
        );

        $this->assertApiResponse($inventoryDetail->toArray());
    }

    /**
     * @test
     */
    public function test_update_inventory_detail()
    {
        $inventoryDetail = InventoryDetail::factory()->create();
        $editedInventoryDetail = InventoryDetail::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/inventory_details/'.$inventoryDetail->id,
            $editedInventoryDetail
        );

        $this->assertApiResponse($editedInventoryDetail);
    }

    /**
     * @test
     */
    public function test_delete_inventory_detail()
    {
        $inventoryDetail = InventoryDetail::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/inventory_details/'.$inventoryDetail->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/inventory_details/'.$inventoryDetail->id
        );

        $this->response->assertStatus(404);
    }
}
