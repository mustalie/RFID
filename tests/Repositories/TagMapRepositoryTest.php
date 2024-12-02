<?php namespace Tests\Repositories;

use App\Models\TagMap;
use App\Repositories\TagMapRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TagMapRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TagMapRepository
     */
    protected $tagMapRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tagMapRepo = \App::make(TagMapRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_tag_map()
    {
        $tagMap = TagMap::factory()->make()->toArray();

        $createdTagMap = $this->tagMapRepo->create($tagMap);

        $createdTagMap = $createdTagMap->toArray();
        $this->assertArrayHasKey('id', $createdTagMap);
        $this->assertNotNull($createdTagMap['id'], 'Created TagMap must have id specified');
        $this->assertNotNull(TagMap::find($createdTagMap['id']), 'TagMap with given id must be in DB');
        $this->assertModelData($tagMap, $createdTagMap);
    }

    /**
     * @test read
     */
    public function test_read_tag_map()
    {
        $tagMap = TagMap::factory()->create();

        $dbTagMap = $this->tagMapRepo->find($tagMap->id);

        $dbTagMap = $dbTagMap->toArray();
        $this->assertModelData($tagMap->toArray(), $dbTagMap);
    }

    /**
     * @test update
     */
    public function test_update_tag_map()
    {
        $tagMap = TagMap::factory()->create();
        $fakeTagMap = TagMap::factory()->make()->toArray();

        $updatedTagMap = $this->tagMapRepo->update($fakeTagMap, $tagMap->id);

        $this->assertModelData($fakeTagMap, $updatedTagMap->toArray());
        $dbTagMap = $this->tagMapRepo->find($tagMap->id);
        $this->assertModelData($fakeTagMap, $dbTagMap->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_tag_map()
    {
        $tagMap = TagMap::factory()->create();

        $resp = $this->tagMapRepo->delete($tagMap->id);

        $this->assertTrue($resp);
        $this->assertNull(TagMap::find($tagMap->id), 'TagMap should not exist in DB');
    }
}
