<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInventoryGroupAPIRequest;
use App\Http\Requests\API\UpdateInventoryGroupAPIRequest;
use App\Models\InventoryGroup;
use App\Repositories\InventoryGroupRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class InventoryGroupController
 * @package App\Http\Controllers\API
 */

class InventoryGroupAPIController extends AppBaseController
{
    /** @var  InventoryGroupRepository */
    private $inventoryGroupRepository;

    public function __construct(InventoryGroupRepository $inventoryGroupRepo)
    {
        $this->inventoryGroupRepository = $inventoryGroupRepo;
    }

    /**
     * Display a listing of the InventoryGroup.
     * GET|HEAD /inventoryGroups
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $inventoryGroups = $this->inventoryGroupRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($inventoryGroups->toArray(), 'Inventory Groups retrieved successfully');
    }

    /**
     * Store a newly created InventoryGroup in storage.
     * POST /inventoryGroups
     *
     * @param CreateInventoryGroupAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateInventoryGroupAPIRequest $request)
    {
        $input = $request->all();

        $inventoryGroup = $this->inventoryGroupRepository->create($input);

        return $this->sendResponse($inventoryGroup->toArray(), 'Inventory Group saved successfully');
    }

    /**
     * Display the specified InventoryGroup.
     * GET|HEAD /inventoryGroups/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var InventoryGroup $inventoryGroup */
        $inventoryGroup = $this->inventoryGroupRepository->find($id);

        if (empty($inventoryGroup)) {
            return $this->sendError('Inventory Group not found');
        }

        return $this->sendResponse($inventoryGroup->toArray(), 'Inventory Group retrieved successfully');
    }

    /**
     * Update the specified InventoryGroup in storage.
     * PUT/PATCH /inventoryGroups/{id}
     *
     * @param int $id
     * @param UpdateInventoryGroupAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInventoryGroupAPIRequest $request)
    {
        $input = $request->all();

        /** @var InventoryGroup $inventoryGroup */
        $inventoryGroup = $this->inventoryGroupRepository->find($id);

        if (empty($inventoryGroup)) {
            return $this->sendError('Inventory Group not found');
        }

        $inventoryGroup = $this->inventoryGroupRepository->update($input, $id);

        return $this->sendResponse($inventoryGroup->toArray(), 'InventoryGroup updated successfully');
    }

    /**
     * Remove the specified InventoryGroup from storage.
     * DELETE /inventoryGroups/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var InventoryGroup $inventoryGroup */
        $inventoryGroup = $this->inventoryGroupRepository->find($id);

        if (empty($inventoryGroup)) {
            return $this->sendError('Inventory Group not found');
        }

        $inventoryGroup->delete();

        return $this->sendSuccess('Inventory Group deleted successfully');
    }
}
