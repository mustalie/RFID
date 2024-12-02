<?php namespace Tests\Repositories;

use App\Models\InventoryDetail;
use App\Repositories\InventoryDetailRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class InventoryDetailRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var InventoryDetailRepository
     */
    protected $inventoryDetailRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->inventoryDetailRepo = \App::make(InventoryDetailRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_inventory_detail()
    {
        $inventoryDetail = InventoryDetail::factory()->make()->toArray();

        $createdInventoryDetail = $this->inventoryDetailRepo->create($inventoryDetail);

        $createdInventoryDetail = $createdInventoryDetail->toArray();
        $this->assertArrayHasKey('id', $createdInventoryDetail);
        $this->assertNotNull($createdInventoryDetail['id'], 'Created InventoryDetail must have id specified');
        $this->assertNotNull(InventoryDetail::find($createdInventoryDetail['id']), 'InventoryDetail with given id must be in DB');
        $this->assertModelData($inventoryDetail, $createdInventoryDetail);
    }

    /**
     * @test read
     */
    public function test_read_inventory_detail()
    {
        $inventoryDetail = InventoryDetail::factory()->create();

        $dbInventoryDetail = $this->inventoryDetailRepo->find($inventoryDetail->id);

        $dbInventoryDetail = $dbInventoryDetail->toArray();
        $this->assertModelData($inventoryDetail->toArray(), $dbInventoryDetail);
    }

    /**
     * @test update
     */
    public function test_update_inventory_detail()
    {
        $inventoryDetail = InventoryDetail::factory()->create();
        $fakeInventoryDetail = InventoryDetail::factory()->make()->toArray();

        $updatedInventoryDetail = $this->inventoryDetailRepo->update($fakeInventoryDetail, $inventoryDetail->id);

        $this->assertModelData($fakeInventoryDetail, $updatedInventoryDetail->toArray());
        $dbInventoryDetail = $this->inventoryDetailRepo->find($inventoryDetail->id);
        $this->assertModelData($fakeInventoryDetail, $dbInventoryDetail->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_inventory_detail()
    {
        $inventoryDetail = InventoryDetail::factory()->create();

        $resp = $this->inventoryDetailRepo->delete($inventoryDetail->id);

        $this->assertTrue($resp);
        $this->assertNull(InventoryDetail::find($inventoryDetail->id), 'InventoryDetail should not exist in DB');
    }
}
