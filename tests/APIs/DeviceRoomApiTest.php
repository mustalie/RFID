<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\DeviceRoom;

class DeviceRoomApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_device_room()
    {
        $deviceRoom = DeviceRoom::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/device_rooms', $deviceRoom
        );

        $this->assertApiResponse($deviceRoom);
    }

    /**
     * @test
     */
    public function test_read_device_room()
    {
        $deviceRoom = DeviceRoom::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/device_rooms/'.$deviceRoom->id
        );

        $this->assertApiResponse($deviceRoom->toArray());
    }

    /**
     * @test
     */
    public function test_update_device_room()
    {
        $deviceRoom = DeviceRoom::factory()->create();
        $editedDeviceRoom = DeviceRoom::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/device_rooms/'.$deviceRoom->id,
            $editedDeviceRoom
        );

        $this->assertApiResponse($editedDeviceRoom);
    }

    /**
     * @test
     */
    public function test_delete_device_room()
    {
        $deviceRoom = DeviceRoom::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/device_rooms/'.$deviceRoom->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/device_rooms/'.$deviceRoom->id
        );

        $this->response->assertStatus(404);
    }
}
