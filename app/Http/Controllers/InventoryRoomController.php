<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInventoryRoomRequest;
use App\Http\Requests\UpdateInventoryRoomRequest;
use App\Repositories\InventoryRoomRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class InventoryRoomController extends AppBaseController
{
    /** @var InventoryRoomRepository $inventoryRoomRepository*/
    private $inventoryRoomRepository;

    public function __construct(InventoryRoomRepository $inventoryRoomRepo)
    {
        $this->inventoryRoomRepository = $inventoryRoomRepo;
    }

    /**
     * Display a listing of the InventoryRoom.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $inventoryRooms = $this->inventoryRoomRepository->all();

        return view('inventory_rooms.index')
            ->with('inventoryRooms', $inventoryRooms);
    }

    /**
     * Show the form for creating a new InventoryRoom.
     *
     * @return Response
     */
    public function create()
    {
        return view('inventory_rooms.create');
    }

    /**
     * Store a newly created InventoryRoom in storage.
     *
     * @param CreateInventoryRoomRequest $request
     *
     * @return Response
     */
    public function store(CreateInventoryRoomRequest $request)
    {
        $input = $request->all();

        $inventoryRoom = $this->inventoryRoomRepository->create($input);

        Flash::success('Inventory Room saved successfully.');

        return redirect(route('inventoryRooms.index'));
    }

    /**
     * Display the specified InventoryRoom.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $inventoryRoom = $this->inventoryRoomRepository->find($id);

        if (empty($inventoryRoom)) {
            Flash::error('Inventory Room not found');

            return redirect(route('inventoryRooms.index'));
        }

        return view('inventory_rooms.show')->with('inventoryRoom', $inventoryRoom);
    }

    /**
     * Show the form for editing the specified InventoryRoom.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $inventoryRoom = $this->inventoryRoomRepository->find($id);

        if (empty($inventoryRoom)) {
            Flash::error('Inventory Room not found');

            return redirect(route('inventoryRooms.index'));
        }

        return view('inventory_rooms.edit')->with('inventoryRoom', $inventoryRoom);
    }

    /**
     * Update the specified InventoryRoom in storage.
     *
     * @param int $id
     * @param UpdateInventoryRoomRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInventoryRoomRequest $request)
    {
        $inventoryRoom = $this->inventoryRoomRepository->find($id);

        if (empty($inventoryRoom)) {
            Flash::error('Inventory Room not found');

            return redirect(route('inventoryRooms.index'));
        }

        $inventoryRoom = $this->inventoryRoomRepository->update($request->all(), $id);

        Flash::success('Inventory Room updated successfully.');

        return redirect(route('inventoryRooms.index'));
    }

    /**
     * Remove the specified InventoryRoom from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inventoryRoom = $this->inventoryRoomRepository->find($id);

        if (empty($inventoryRoom)) {
            Flash::error('Inventory Room not found');

            return redirect(route('inventoryRooms.index'));
        }

        $this->inventoryRoomRepository->delete($id);

        Flash::success('Inventory Room deleted successfully.');

        return redirect(route('inventoryRooms.index'));
    }
}
