<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInventoryDetailAPIRequest;
use App\Http\Requests\API\UpdateInventoryDetailAPIRequest;
use App\Models\InventoryDetail;
use App\Repositories\InventoryDetailRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class InventoryDetailController
 * @package App\Http\Controllers\API
 */

class InventoryDetailAPIController extends AppBaseController
{
    /** @var  InventoryDetailRepository */
    private $inventoryDetailRepository;

    public function __construct(InventoryDetailRepository $inventoryDetailRepo)
    {
        $this->inventoryDetailRepository = $inventoryDetailRepo;
    }

    /**
     * Display a listing of the InventoryDetail.
     * GET|HEAD /inventoryDetails
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $inventoryDetails = $this->inventoryDetailRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($inventoryDetails->toArray(), 'Inventory Details retrieved successfully');
    }

    /**
     * Store a newly created InventoryDetail in storage.
     * POST /inventoryDetails
     *
     * @param CreateInventoryDetailAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateInventoryDetailAPIRequest $request)
    {
        $input = $request->all();

        $inventoryDetail = $this->inventoryDetailRepository->create($input);

        return $this->sendResponse($inventoryDetail->toArray(), 'Inventory Detail saved successfully');
    }

    /**
     * Display the specified InventoryDetail.
     * GET|HEAD /inventoryDetails/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var InventoryDetail $inventoryDetail */
        $inventoryDetail = $this->inventoryDetailRepository->find($id);

        if (empty($inventoryDetail)) {
            return $this->sendError('Inventory Detail not found');
        }

        return $this->sendResponse($inventoryDetail->toArray(), 'Inventory Detail retrieved successfully');
    }

    /**
     * Update the specified InventoryDetail in storage.
     * PUT/PATCH /inventoryDetails/{id}
     *
     * @param int $id
     * @param UpdateInventoryDetailAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInventoryDetailAPIRequest $request)
    {
        $input = $request->all();

        /** @var InventoryDetail $inventoryDetail */
        $inventoryDetail = $this->inventoryDetailRepository->find($id);

        if (empty($inventoryDetail)) {
            return $this->sendError('Inventory Detail not found');
        }

        $inventoryDetail = $this->inventoryDetailRepository->update($input, $id);

        return $this->sendResponse($inventoryDetail->toArray(), 'InventoryDetail updated successfully');
    }

    /**
     * Remove the specified InventoryDetail from storage.
     * DELETE /inventoryDetails/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var InventoryDetail $inventoryDetail */
        $inventoryDetail = $this->inventoryDetailRepository->find($id);

        if (empty($inventoryDetail)) {
            return $this->sendError('Inventory Detail not found');
        }

        $inventoryDetail->delete();

        return $this->sendSuccess('Inventory Detail deleted successfully');
    }
}
