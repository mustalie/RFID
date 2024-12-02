<?php namespace Tests\Repositories;

use App\Models\InventoryGroup;
use App\Repositories\InventoryGroupRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class InventoryGroupRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var InventoryGroupRepository
     */
    protected $inventoryGroupRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->inventoryGroupRepo = \App::make(InventoryGroupRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_inventory_group()
    {
        $inventoryGroup = InventoryGroup::factory()->make()->toArray();

        $createdInventoryGroup = $this->inventoryGroupRepo->create($inventoryGroup);

        $createdInventoryGroup = $createdInventoryGroup->toArray();
        $this->assertArrayHasKey('id', $createdInventoryGroup);
        $this->assertNotNull($createdInventoryGroup['id'], 'Created InventoryGroup must have id specified');
        $this->assertNotNull(InventoryGroup::find($createdInventoryGroup['id']), 'InventoryGroup with given id must be in DB');
        $this->assertModelData($inventoryGroup, $createdInventoryGroup);
    }

    /**
     * @test read
     */
    public function test_read_inventory_group()
    {
        $inventoryGroup = InventoryGroup::factory()->create();

        $dbInventoryGroup = $this->inventoryGroupRepo->find($inventoryGroup->id);

        $dbInventoryGroup = $dbInventoryGroup->toArray();
        $this->assertModelData($inventoryGroup->toArray(), $dbInventoryGroup);
    }

    /**
     * @test update
     */
    public function test_update_inventory_group()
    {
        $inventoryGroup = InventoryGroup::factory()->create();
        $fakeInventoryGroup = InventoryGroup::factory()->make()->toArray();

        $updatedInventoryGroup = $this->inventoryGroupRepo->update($fakeInventoryGroup, $inventoryGroup->id);

        $this->assertModelData($fakeInventoryGroup, $updatedInventoryGroup->toArray());
        $dbInventoryGroup = $this->inventoryGroupRepo->find($inventoryGroup->id);
        $this->assertModelData($fakeInventoryGroup, $dbInventoryGroup->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_inventory_group()
    {
        $inventoryGroup = InventoryGroup::factory()->create();

        $resp = $this->inventoryGroupRepo->delete($inventoryGroup->id);

        $this->assertTrue($resp);
        $this->assertNull(InventoryGroup::find($inventoryGroup->id), 'InventoryGroup should not exist in DB');
    }
}
