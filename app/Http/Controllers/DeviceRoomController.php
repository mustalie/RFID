<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDeviceRoomRequest;
use App\Http\Requests\UpdateDeviceRoomRequest;
use App\Repositories\DeviceRoomRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class DeviceRoomController extends AppBaseController
{
    /** @var DeviceRoomRepository $deviceRoomRepository*/
    private $deviceRoomRepository;

    public function __construct(DeviceRoomRepository $deviceRoomRepo)
    {
        $this->deviceRoomRepository = $deviceRoomRepo;
    }

    /**
     * Display a listing of the DeviceRoom.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $deviceRooms = $this->deviceRoomRepository->all();

        return view('device_rooms.index')
            ->with('deviceRooms', $deviceRooms);
    }

    /**
     * Show the form for creating a new DeviceRoom.
     *
     * @return Response
     */
    public function create()
    {
        return view('device_rooms.create');
    }

    /**
     * Store a newly created DeviceRoom in storage.
     *
     * @param CreateDeviceRoomRequest $request
     *
     * @return Response
     */
    public function store(CreateDeviceRoomRequest $request)
    {
        $input = $request->all();

        $deviceRoom = $this->deviceRoomRepository->create($input);

        Flash::success('Device Room saved successfully.');

        return redirect(route('deviceRooms.index'));
    }

    /**
     * Display the specified DeviceRoom.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $deviceRoom = $this->deviceRoomRepository->find($id);

        if (empty($deviceRoom)) {
            Flash::error('Device Room not found');

            return redirect(route('deviceRooms.index'));
        }

        return view('device_rooms.show')->with('deviceRoom', $deviceRoom);
    }

    /**
     * Show the form for editing the specified DeviceRoom.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $deviceRoom = $this->deviceRoomRepository->find($id);

        if (empty($deviceRoom)) {
            Flash::error('Device Room not found');

            return redirect(route('deviceRooms.index'));
        }

        return view('device_rooms.edit')->with('deviceRoom', $deviceRoom);
    }

    /**
     * Update the specified DeviceRoom in storage.
     *
     * @param int $id
     * @param UpdateDeviceRoomRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeviceRoomRequest $request)
    {
        $deviceRoom = $this->deviceRoomRepository->find($id);

        if (empty($deviceRoom)) {
            Flash::error('Device Room not found');

            return redirect(route('deviceRooms.index'));
        }

        $deviceRoom = $this->deviceRoomRepository->update($request->all(), $id);

        Flash::success('Device Room updated successfully.');

        return redirect(route('deviceRooms.index'));
    }

    /**
     * Remove the specified DeviceRoom from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $deviceRoom = $this->deviceRoomRepository->find($id);

        if (empty($deviceRoom)) {
            Flash::error('Device Room not found');

            return redirect(route('deviceRooms.index'));
        }

        $this->deviceRoomRepository->delete($id);

        Flash::success('Device Room deleted successfully.');

        return redirect(route('deviceRooms.index'));
    }
}
