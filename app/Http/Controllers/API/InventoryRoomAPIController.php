<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInventoryRoomAPIRequest;
use App\Http\Requests\API\UpdateInventoryRoomAPIRequest;
use App\Models\InventoryRoom;
use App\Repositories\InventoryRoomRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class InventoryRoomController
 * @package App\Http\Controllers\API
 */

class InventoryRoomAPIController extends AppBaseController
{
    /** @var  InventoryRoomRepository */
    private $inventoryRoomRepository;

    public function __construct(InventoryRoomRepository $inventoryRoomRepo)
    {
        $this->inventoryRoomRepository = $inventoryRoomRepo;
    }

    /**
     * Display a listing of the InventoryRoom.
     * GET|HEAD /inventoryRooms
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $inventoryRooms = $this->inventoryRoomRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($inventoryRooms->toArray(), 'Inventory Rooms retrieved successfully');
    }

    /**
     * Store a newly created InventoryRoom in storage.
     * POST /inventoryRooms
     *
     * @param CreateInventoryRoomAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateInventoryRoomAPIRequest $request)
    {
        $input = $request->all();

        $inventoryRoom = $this->inventoryRoomRepository->create($input);

        return $this->sendResponse($inventoryRoom->toArray(), 'Inventory Room saved successfully');
    }

    /**
     * Display the specified InventoryRoom.
     * GET|HEAD /inventoryRooms/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var InventoryRoom $inventoryRoom */
        $inventoryRoom = $this->inventoryRoomRepository->find($id);

        if (empty($inventoryRoom)) {
            return $this->sendError('Inventory Room not found');
        }

        return $this->sendResponse($inventoryRoom->toArray(), 'Inventory Room retrieved successfully');
    }

    /**
     * Update the specified InventoryRoom in storage.
     * PUT/PATCH /inventoryRooms/{id}
     *
     * @param int $id
     * @param UpdateInventoryRoomAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInventoryRoomAPIRequest $request)
    {
        $input = $request->all();

        /** @var InventoryRoom $inventoryRoom */
        $inventoryRoom = $this->inventoryRoomRepository->find($id);

        if (empty($inventoryRoom)) {
            return $this->sendError('Inventory Room not found');
        }

        $inventoryRoom = $this->inventoryRoomRepository->update($input, $id);

        return $this->sendResponse($inventoryRoom->toArray(), 'InventoryRoom updated successfully');
    }

    /**
     * Remove the specified InventoryRoom from storage.
     * DELETE /inventoryRooms/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var InventoryRoom $inventoryRoom */
        $inventoryRoom = $this->inventoryRoomRepository->find($id);

        if (empty($inventoryRoom)) {
            return $this->sendError('Inventory Room not found');
        }

        $inventoryRoom->delete();

        return $this->sendSuccess('Inventory Room deleted successfully');
    }
}
