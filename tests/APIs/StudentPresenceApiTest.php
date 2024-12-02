<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\StudentPresence;

class StudentPresenceApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_student_presence()
    {
        $studentPresence = StudentPresence::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/student_presences', $studentPresence
        );

        $this->assertApiResponse($studentPresence);
    }

    /**
     * @test
     */
    public function test_read_student_presence()
    {
        $studentPresence = StudentPresence::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/student_presences/'.$studentPresence->id
        );

        $this->assertApiResponse($studentPresence->toArray());
    }

    /**
     * @test
     */
    public function test_update_student_presence()
    {
        $studentPresence = StudentPresence::factory()->create();
        $editedStudentPresence = StudentPresence::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/student_presences/'.$studentPresence->id,
            $editedStudentPresence
        );

        $this->assertApiResponse($editedStudentPresence);
    }

    /**
     * @test
     */
    public function test_delete_student_presence()
    {
        $studentPresence = StudentPresence::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/student_presences/'.$studentPresence->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/student_presences/'.$studentPresence->id
        );

        $this->response->assertStatus(404);
    }
}
