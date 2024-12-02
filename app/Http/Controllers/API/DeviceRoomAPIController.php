<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDeviceRoomAPIRequest;
use App\Http\Requests\API\UpdateDeviceRoomAPIRequest;
use App\Models\DeviceRoom;
use App\Repositories\DeviceRoomRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\Room;
use Response;

/**
 * Class DeviceRoomController
 * @package App\Http\Controllers\API
 */

class DeviceRoomAPIController extends AppBaseController
{
    /** @var  DeviceRoomRepository */
    private $deviceRoomRepository;

    public function __construct(DeviceRoomRepository $deviceRoomRepo)
    {
        $this->deviceRoomRepository = $deviceRoomRepo;
    }

    /**
     * Display a listing of the DeviceRoom.
     * GET|HEAD /deviceRooms
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        /*$deviceRooms = $this->deviceRoomRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );*/

        $deviceRooms = DeviceRoom::with('room')->get();

        return $this->sendResponse($deviceRooms->toArray(), 'Device Rooms retrieved successfully');
    }

    /**
     * Store a newly created DeviceRoom in storage.
     * POST /deviceRooms
     *
     * @param CreateDeviceRoomAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDeviceRoomAPIRequest $request)
    {
        $input = $request->all();

        $deviceRoom = $this->deviceRoomRepository->create($input);

        return $this->sendResponse($deviceRoom->toArray(), 'Device Room saved successfully');
    }

    public function get(Request $request)
    {
        $device_id = $request->input('device_id');
        $deviceRooms = DeviceRoom::with('room')
            ->where('device_id', $device_id)
            ->orderBy('antenna', 'asc')
            ->get();

        return $this->sendResponse($deviceRooms->toArray(), 'Device Rooms retrieved successfully');
    }

    public function save(Request $request) {
        $device_id = $request->input('device_id');
        $room_ids = $request->input('room_ids');
        $antennas = $request->input('antennas');

        $room_ids = explode(',', $room_ids);
        $rooms = Room::whereIn('id', $room_ids)->get();

        if (sizeof($rooms) < 4) {
            return $this->sendError('Invalid room');
        }

        $antennas = explode(',', $antennas);

        foreach($antennas as $k=>$antenna) {
            $antenna = DeviceRoom::firstOrNew(['device_id' => $device_id, 'antenna' => $antenna]);
            $antenna->room_id = $room_ids[$k];
            $antenna->save();
        }

        return $this->sendResponse([], 'Device Room has been saved successfully');

    }

    /**
     * Display the specified DeviceRoom.
     * GET|HEAD /deviceRooms/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var DeviceRoom $deviceRoom */
        $deviceRoom = $this->deviceRoomRepository->find($id);

        if (empty($deviceRoom)) {
            return $this->sendError('Device Room not found');
        }

        return $this->sendResponse($deviceRoom->toArray(), 'Device Room retrieved successfully');
    }

    /**
     * Update the specified DeviceRoom in storage.
     * PUT/PATCH /deviceRooms/{id}
     *
     * @param int $id
     * @param UpdateDeviceRoomAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeviceRoomAPIRequest $request)
    {
        $input = $request->all();

        /** @var DeviceRoom $deviceRoom */
        $deviceRoom = $this->deviceRoomRepository->find($id);

        if (empty($deviceRoom)) {
            return $this->sendError('Device Room not found');
        }

        $deviceRoom = $this->deviceRoomRepository->update($input, $id);

        return $this->sendResponse($deviceRoom->toArray(), 'DeviceRoom updated successfully');
    }

    /**
     * Remove the specified DeviceRoom from storage.
     * DELETE /deviceRooms/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var DeviceRoom $deviceRoom */
        $deviceRoom = $this->deviceRoomRepository->find($id);

        if (empty($deviceRoom)) {
            return $this->sendError('Device Room not found');
        }

        $deviceRoom->delete();

        return $this->sendSuccess('Device Room deleted successfully');
    }
}
