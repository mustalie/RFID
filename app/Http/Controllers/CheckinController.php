<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCheckinRequest;
use App\Http\Requests\UpdateCheckinRequest;
use App\Repositories\CheckinRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CheckinController extends AppBaseController
{
    /** @var CheckinRepository $checkinRepository*/
    private $checkinRepository;

    public function __construct(CheckinRepository $checkinRepo)
    {
        $this->checkinRepository = $checkinRepo;
    }

    /**
     * Display a listing of the Checkin.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $checkins = $this->checkinRepository->all();

        return view('checkins.index')
            ->with('checkins', $checkins);
    }

    /**
     * Show the form for creating a new Checkin.
     *
     * @return Response
     */
    public function create()
    {
        return view('checkins.create');
    }

    /**
     * Store a newly created Checkin in storage.
     *
     * @param CreateCheckinRequest $request
     *
     * @return Response
     */
    public function store(CreateCheckinRequest $request)
    {
        $input = $request->all();

        $checkin = $this->checkinRepository->create($input);

        Flash::success('Checkin saved successfully.');

        return redirect(route('checkins.index'));
    }

    /**
     * Display the specified Checkin.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $checkin = $this->checkinRepository->find($id);

        if (empty($checkin)) {
            Flash::error('Checkin not found');

            return redirect(route('checkins.index'));
        }

        return view('checkins.show')->with('checkin', $checkin);
    }

    /**
     * Show the form for editing the specified Checkin.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $checkin = $this->checkinRepository->find($id);

        if (empty($checkin)) {
            Flash::error('Checkin not found');

            return redirect(route('checkins.index'));
        }

        return view('checkins.edit')->with('checkin', $checkin);
    }

    /**
     * Update the specified Checkin in storage.
     *
     * @param int $id
     * @param UpdateCheckinRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCheckinRequest $request)
    {
        $checkin = $this->checkinRepository->find($id);

        if (empty($checkin)) {
            Flash::error('Checkin not found');

            return redirect(route('checkins.index'));
        }

        $checkin = $this->checkinRepository->update($request->all(), $id);

        Flash::success('Checkin updated successfully.');

        return redirect(route('checkins.index'));
    }

    /**
     * Remove the specified Checkin from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $checkin = $this->checkinRepository->find($id);

        if (empty($checkin)) {
            Flash::error('Checkin not found');

            return redirect(route('checkins.index'));
        }

        $this->checkinRepository->delete($id);

        Flash::success('Checkin deleted successfully.');

        return redirect(route('checkins.index'));
    }
}
