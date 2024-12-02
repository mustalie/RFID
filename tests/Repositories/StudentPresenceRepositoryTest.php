<?php namespace Tests\Repositories;

use App\Models\StudentPresence;
use App\Repositories\StudentPresenceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StudentPresenceRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StudentPresenceRepository
     */
    protected $studentPresenceRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->studentPresenceRepo = \App::make(StudentPresenceRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_student_presence()
    {
        $studentPresence = StudentPresence::factory()->make()->toArray();

        $createdStudentPresence = $this->studentPresenceRepo->create($studentPresence);

        $createdStudentPresence = $createdStudentPresence->toArray();
        $this->assertArrayHasKey('id', $createdStudentPresence);
        $this->assertNotNull($createdStudentPresence['id'], 'Created StudentPresence must have id specified');
        $this->assertNotNull(StudentPresence::find($createdStudentPresence['id']), 'StudentPresence with given id must be in DB');
        $this->assertModelData($studentPresence, $createdStudentPresence);
    }

    /**
     * @test read
     */
    public function test_read_student_presence()
    {
        $studentPresence = StudentPresence::factory()->create();

        $dbStudentPresence = $this->studentPresenceRepo->find($studentPresence->id);

        $dbStudentPresence = $dbStudentPresence->toArray();
        $this->assertModelData($studentPresence->toArray(), $dbStudentPresence);
    }

    /**
     * @test update
     */
    public function test_update_student_presence()
    {
        $studentPresence = StudentPresence::factory()->create();
        $fakeStudentPresence = StudentPresence::factory()->make()->toArray();

        $updatedStudentPresence = $this->studentPresenceRepo->update($fakeStudentPresence, $studentPresence->id);

        $this->assertModelData($fakeStudentPresence, $updatedStudentPresence->toArray());
        $dbStudentPresence = $this->studentPresenceRepo->find($studentPresence->id);
        $this->assertModelData($fakeStudentPresence, $dbStudentPresence->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_student_presence()
    {
        $studentPresence = StudentPresence::factory()->create();

        $resp = $this->studentPresenceRepo->delete($studentPresence->id);

        $this->assertTrue($resp);
        $this->assertNull(StudentPresence::find($studentPresence->id), 'StudentPresence should not exist in DB');
    }
}
