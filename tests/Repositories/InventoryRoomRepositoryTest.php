<?php namespace Tests\Repositories;

use App\Models\InventoryRoom;
use App\Repositories\InventoryRoomRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class InventoryRoomRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var InventoryRoomRepository
     */
    protected $inventoryRoomRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->inventoryRoomRepo = \App::make(InventoryRoomRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_inventory_room()
    {
        $inventoryRoom = InventoryRoom::factory()->make()->toArray();

        $createdInventoryRoom = $this->inventoryRoomRepo->create($inventoryRoom);

        $createdInventoryRoom = $createdInventoryRoom->toArray();
        $this->assertArrayHasKey('id', $createdInventoryRoom);
        $this->assertNotNull($createdInventoryRoom['id'], 'Created InventoryRoom must have id specified');
        $this->assertNotNull(InventoryRoom::find($createdInventoryRoom['id']), 'InventoryRoom with given id must be in DB');
        $this->assertModelData($inventoryRoom, $createdInventoryRoom);
    }

    /**
     * @test read
     */
    public function test_read_inventory_room()
    {
        $inventoryRoom = InventoryRoom::factory()->create();

        $dbInventoryRoom = $this->inventoryRoomRepo->find($inventoryRoom->id);

        $dbInventoryRoom = $dbInventoryRoom->toArray();
        $this->assertModelData($inventoryRoom->toArray(), $dbInventoryRoom);
    }

    /**
     * @test update
     */
    public function test_update_inventory_room()
    {
        $inventoryRoom = InventoryRoom::factory()->create();
        $fakeInventoryRoom = InventoryRoom::factory()->make()->toArray();

        $updatedInventoryRoom = $this->inventoryRoomRepo->update($fakeInventoryRoom, $inventoryRoom->id);

        $this->assertModelData($fakeInventoryRoom, $updatedInventoryRoom->toArray());
        $dbInventoryRoom = $this->inventoryRoomRepo->find($inventoryRoom->id);
        $this->assertModelData($fakeInventoryRoom, $dbInventoryRoom->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_inventory_room()
    {
        $inventoryRoom = InventoryRoom::factory()->create();

        $resp = $this->inventoryRoomRepo->delete($inventoryRoom->id);

        $this->assertTrue($resp);
        $this->assertNull(InventoryRoom::find($inventoryRoom->id), 'InventoryRoom should not exist in DB');
    }
}
