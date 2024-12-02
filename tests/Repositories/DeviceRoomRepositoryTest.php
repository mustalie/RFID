<?php namespace Tests\Repositories;

use App\Models\DeviceRoom;
use App\Repositories\DeviceRoomRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class DeviceRoomRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var DeviceRoomRepository
     */
    protected $deviceRoomRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->deviceRoomRepo = \App::make(DeviceRoomRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_device_room()
    {
        $deviceRoom = DeviceRoom::factory()->make()->toArray();

        $createdDeviceRoom = $this->deviceRoomRepo->create($deviceRoom);

        $createdDeviceRoom = $createdDeviceRoom->toArray();
        $this->assertArrayHasKey('id', $createdDeviceRoom);
        $this->assertNotNull($createdDeviceRoom['id'], 'Created DeviceRoom must have id specified');
        $this->assertNotNull(DeviceRoom::find($createdDeviceRoom['id']), 'DeviceRoom with given id must be in DB');
        $this->assertModelData($deviceRoom, $createdDeviceRoom);
    }

    /**
     * @test read
     */
    public function test_read_device_room()
    {
        $deviceRoom = DeviceRoom::factory()->create();

        $dbDeviceRoom = $this->deviceRoomRepo->find($deviceRoom->id);

        $dbDeviceRoom = $dbDeviceRoom->toArray();
        $this->assertModelData($deviceRoom->toArray(), $dbDeviceRoom);
    }

    /**
     * @test update
     */
    public function test_update_device_room()
    {
        $deviceRoom = DeviceRoom::factory()->create();
        $fakeDeviceRoom = DeviceRoom::factory()->make()->toArray();

        $updatedDeviceRoom = $this->deviceRoomRepo->update($fakeDeviceRoom, $deviceRoom->id);

        $this->assertModelData($fakeDeviceRoom, $updatedDeviceRoom->toArray());
        $dbDeviceRoom = $this->deviceRoomRepo->find($deviceRoom->id);
        $this->assertModelData($fakeDeviceRoom, $dbDeviceRoom->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_device_room()
    {
        $deviceRoom = DeviceRoom::factory()->create();

        $resp = $this->deviceRoomRepo->delete($deviceRoom->id);

        $this->assertTrue($resp);
        $this->assertNull(DeviceRoom::find($deviceRoom->id), 'DeviceRoom should not exist in DB');
    }
}
