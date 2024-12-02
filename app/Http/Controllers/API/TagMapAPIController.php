<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTagMapAPIRequest;
use App\Http\Requests\API\UpdateTagMapAPIRequest;
use App\Models\TagMap;
use App\Repositories\TagMapRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TagMapController
 * @package App\Http\Controllers\API
 */

class TagMapAPIController extends AppBaseController
{
    /** @var  TagMapRepository */
    private $tagMapRepository;

    public function __construct(TagMapRepository $tagMapRepo)
    {
        $this->tagMapRepository = $tagMapRepo;
    }

    /**
     * Display a listing of the TagMap.
     * GET|HEAD /tagMaps
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tagMaps = $this->tagMapRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($tagMaps->toArray(), 'Tag Maps retrieved successfully');
    }

    /**
     * Store a newly created TagMap in storage.
     * POST /tagMaps
     *
     * @param CreateTagMapAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTagMapAPIRequest $request)
    {
        $input = $request->all();

        $tagMap = $this->tagMapRepository->create($input);

        return $this->sendResponse($tagMap->toArray(), 'Tag Map saved successfully');
    }

    /**
     * Display the specified TagMap.
     * GET|HEAD /tagMaps/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var TagMap $tagMap */
        $tagMap = $this->tagMapRepository->find($id);

        if (empty($tagMap)) {
            return $this->sendError('Tag Map not found');
        }

        return $this->sendResponse($tagMap->toArray(), 'Tag Map retrieved successfully');
    }

    /**
     * Update the specified TagMap in storage.
     * PUT/PATCH /tagMaps/{id}
     *
     * @param int $id
     * @param UpdateTagMapAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTagMapAPIRequest $request)
    {
        $input = $request->all();

        /** @var TagMap $tagMap */
        $tagMap = $this->tagMapRepository->find($id);

        if (empty($tagMap)) {
            return $this->sendError('Tag Map not found');
        }

        $tagMap = $this->tagMapRepository->update($input, $id);

        return $this->sendResponse($tagMap->toArray(), 'TagMap updated successfully');
    }

    /**
     * Remove the specified TagMap from storage.
     * DELETE /tagMaps/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var TagMap $tagMap */
        $tagMap = $this->tagMapRepository->find($id);

        if (empty($tagMap)) {
            return $this->sendError('Tag Map not found');
        }

        $tagMap->delete();

        return $this->sendSuccess('Tag Map deleted successfully');
    }
}
