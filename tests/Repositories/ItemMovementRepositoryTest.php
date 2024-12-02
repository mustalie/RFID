<?php namespace Tests\Repositories;

use App\Models\ItemMovement;
use App\Repositories\ItemMovementRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ItemMovementRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ItemMovementRepository
     */
    protected $itemMovementRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->itemMovementRepo = \App::make(ItemMovementRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_item_movement()
    {
        $itemMovement = ItemMovement::factory()->make()->toArray();

        $createdItemMovement = $this->itemMovementRepo->create($itemMovement);

        $createdItemMovement = $createdItemMovement->toArray();
        $this->assertArrayHasKey('id', $createdItemMovement);
        $this->assertNotNull($createdItemMovement['id'], 'Created ItemMovement must have id specified');
        $this->assertNotNull(ItemMovement::find($createdItemMovement['id']), 'ItemMovement with given id must be in DB');
        $this->assertModelData($itemMovement, $createdItemMovement);
    }

    /**
     * @test read
     */
    public function test_read_item_movement()
    {
        $itemMovement = ItemMovement::factory()->create();

        $dbItemMovement = $this->itemMovementRepo->find($itemMovement->id);

        $dbItemMovement = $dbItemMovement->toArray();
        $this->assertModelData($itemMovement->toArray(), $dbItemMovement);
    }

    /**
     * @test update
     */
    public function test_update_item_movement()
    {
        $itemMovement = ItemMovement::factory()->create();
        $fakeItemMovement = ItemMovement::factory()->make()->toArray();

        $updatedItemMovement = $this->itemMovementRepo->update($fakeItemMovement, $itemMovement->id);

        $this->assertModelData($fakeItemMovement, $updatedItemMovement->toArray());
        $dbItemMovement = $this->itemMovementRepo->find($itemMovement->id);
        $this->assertModelData($fakeItemMovement, $dbItemMovement->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_item_movement()
    {
        $itemMovement = ItemMovement::factory()->create();

        $resp = $this->itemMovementRepo->delete($itemMovement->id);

        $this->assertTrue($resp);
        $this->assertNull(ItemMovement::find($itemMovement->id), 'ItemMovement should not exist in DB');
    }
}
