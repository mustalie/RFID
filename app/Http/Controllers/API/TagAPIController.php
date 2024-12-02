<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTagAPIRequest;
use App\Http\Requests\API\UpdateTagAPIRequest;
use App\Models\Tag;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\Dosen;
use App\Models\InventoryDetail;
use App\Models\InventoryGroup;
use App\Models\InventoryRoom;
use App\Models\Mahasiswa;
use App\Models\Persediaan;
use App\Models\Room;
use App\Models\TagMap;
use Response;

/**
 * Class TagController
 * @package App\Http\Controllers\API
 */

class TagAPIController extends AppBaseController
{
    /** @var  TagRepository */
    private $tagRepository;

    public function __construct(TagRepository $tagRepo)
    {
        $this->tagRepository = $tagRepo;
    }

    /**
     * Display a listing of the Tag.
     * GET|HEAD /tags
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tags = $this->tagRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($tags->toArray(), 'Tags retrieved successfully');
    }

    public function get(Request $request)
    {
        /** @var Tag $tag */
        $tags = $request->input('tags');
        $tags = explode(',', $tags);

        $tags = Tag::with('tagMap', 'tagMap.student')
            ->whereIn('tag', $tags)
            ->whereHas('tagMap', function($query){
                $query->where('item_type', TagMap::TYPE_STUDENT);
            })
            ->get();

        if (empty($tags)) {
            return $this->sendError('Tags not found');
        }

        //var_dump($tags); die();

        //$tags = $this->convert_from_latin1_to_utf8_recursively($tags);

        return $this->sendResponse($tags->toArray(), 'Tags retrieved successfully');
    }

    public function get_old(Request $request)
    {
        /** @var Tag $tag */
        $tags = $request->input('tags');
        $tags = explode(',', $tags);

        $tags = Tag::with('tagMap', 'tagMap.student', 'tagMap.dosen', 'tagMap.inventory')
            ->whereIn('tag', $tags)
            ->get();

        var_dump($tags);

        if (empty($tags)) {
            return $this->sendError('Tags not found');
        }

        return $this->sendResponse($tags->toArray(), 'Tags retrieved successfully');
    }

    public function pair(Request $request)
    {
        /** @var Tag $tag */
        $tag = $request->input('tag');
        $item_id = $request->input('item_id');
        $item_type = $request->input('item_type');
        $group_id = $request->input('group_id');
        $room_id = $request->input('room_id');
        
        if (empty($tag) || empty($item_id)) {
            return $this->sendError('Invalid tag or item id');
        }

        switch($item_type) {
            case TagMap::TYPE_STUDENT:
                $item = Mahasiswa::find($item_id);
                break;
            case TagMap::TYPE_DOSEN:
                $item = Dosen::find($item_id);
                break;
            case TagMap::TYPE_INVENTORY:
                $item = Persediaan::find($item_id);
                break;
        }

        if (empty($item)) {
            return $this->sendError('Invalid item');
        }

        if($item_type == TagMap::TYPE_INVENTORY) {
            $room = Room::find($room_id);
            $group = InventoryGroup::find($group_id);

            if (empty($group)) {
                return $this->sendError('Invalid group');
            }

            if (empty($room)) {
                return $this->sendError('Invalid room');
            }
        }

        //$prevTagMap = TagMap::where('item_id', $item_id)->first();
        $tag = Tag::firstOrCreate(['tag' => $tag]);

        TagMap::where('item_id', $item_id)->delete();
        TagMap::firstOrCreate(['tag_id' => $tag->id, 'item_id' => $item_id, 'item_type' => $item_type]);
        
        //if(!empty($prevTagMap)) {
        //    $prevTagMap->delete();
        //}

        if($item_type == TagMap::TYPE_INVENTORY) {
            $inventoryDeatail = InventoryDetail::firstOrNew(['ACC' => $item->ACC]);
            $inventoryDeatail->group_id = $group->id;
            $inventoryDeatail->room_id = $room->id;
            $inventoryDeatail->save();
        }

        return $this->sendResponse([], 'Tag has been paired');
    }

    /**
     * Store a newly created Tag in storage.
     * POST /tags
     *
     * @param CreateTagAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTagAPIRequest $request)
    {
        $input = $request->all();

        $tag = $this->tagRepository->create($input);

        return $this->sendResponse($tag->toArray(), 'Tag saved successfully');
    }

    /**
     * Display the specified Tag.
     * GET|HEAD /tags/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Tag $tag */
        $tag = $this->tagRepository->find($id);

        if (empty($tag)) {
            return $this->sendError('Tag not found');
        }

        return $this->sendResponse($tag->toArray(), 'Tag retrieved successfully');
    }

    /**
     * Update the specified Tag in storage.
     * PUT/PATCH /tags/{id}
     *
     * @param int $id
     * @param UpdateTagAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTagAPIRequest $request)
    {
        $input = $request->all();

        /** @var Tag $tag */
        $tag = $this->tagRepository->find($id);

        if (empty($tag)) {
            return $this->sendError('Tag not found');
        }

        $tag = $this->tagRepository->update($input, $id);

        return $this->sendResponse($tag->toArray(), 'Tag updated successfully');
    }

    /**
     * Remove the specified Tag from storage.
     * DELETE /tags/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Tag $tag */
        $tag = $this->tagRepository->find($id);

        if (empty($tag)) {
            return $this->sendError('Tag not found');
        }

        $tag->delete();

        return $this->sendSuccess('Tag deleted successfully');
    }
}
