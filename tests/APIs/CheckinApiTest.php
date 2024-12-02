<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Checkin;

class CheckinApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_checkin()
    {
        $checkin = Checkin::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/checkins', $checkin
        );

        $this->assertApiResponse($checkin);
    }

    /**
     * @test
     */
    public function test_read_checkin()
    {
        $checkin = Checkin::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/checkins/'.$checkin->id
        );

        $this->assertApiResponse($checkin->toArray());
    }

    /**
     * @test
     */
    public function test_update_checkin()
    {
        $checkin = Checkin::factory()->create();
        $editedCheckin = Checkin::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/checkins/'.$checkin->id,
            $editedCheckin
        );

        $this->assertApiResponse($editedCheckin);
    }

    /**
     * @test
     */
    public function test_delete_checkin()
    {
        $checkin = Checkin::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/checkins/'.$checkin->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/checkins/'.$checkin->id
        );

        $this->response->assertStatus(404);
    }
}
