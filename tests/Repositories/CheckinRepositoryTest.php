<?php namespace Tests\Repositories;

use App\Models\Checkin;
use App\Repositories\CheckinRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CheckinRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CheckinRepository
     */
    protected $checkinRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->checkinRepo = \App::make(CheckinRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_checkin()
    {
        $checkin = Checkin::factory()->make()->toArray();

        $createdCheckin = $this->checkinRepo->create($checkin);

        $createdCheckin = $createdCheckin->toArray();
        $this->assertArrayHasKey('id', $createdCheckin);
        $this->assertNotNull($createdCheckin['id'], 'Created Checkin must have id specified');
        $this->assertNotNull(Checkin::find($createdCheckin['id']), 'Checkin with given id must be in DB');
        $this->assertModelData($checkin, $createdCheckin);
    }

    /**
     * @test read
     */
    public function test_read_checkin()
    {
        $checkin = Checkin::factory()->create();

        $dbCheckin = $this->checkinRepo->find($checkin->id);

        $dbCheckin = $dbCheckin->toArray();
        $this->assertModelData($checkin->toArray(), $dbCheckin);
    }

    /**
     * @test update
     */
    public function test_update_checkin()
    {
        $checkin = Checkin::factory()->create();
        $fakeCheckin = Checkin::factory()->make()->toArray();

        $updatedCheckin = $this->checkinRepo->update($fakeCheckin, $checkin->id);

        $this->assertModelData($fakeCheckin, $updatedCheckin->toArray());
        $dbCheckin = $this->checkinRepo->find($checkin->id);
        $this->assertModelData($fakeCheckin, $dbCheckin->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_checkin()
    {
        $checkin = Checkin::factory()->create();

        $resp = $this->checkinRepo->delete($checkin->id);

        $this->assertTrue($resp);
        $this->assertNull(Checkin::find($checkin->id), 'Checkin should not exist in DB');
    }
}
