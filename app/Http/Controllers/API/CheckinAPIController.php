<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCheckinAPIRequest;
use App\Http\Requests\API\UpdateCheckinAPIRequest;
use App\Models\Checkin;
use App\Repositories\CheckinRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CheckinController
 * @package App\Http\Controllers\API
 */

class CheckinAPIController extends AppBaseController
{
    /** @var  CheckinRepository */
    private $checkinRepository;

    public function __construct(CheckinRepository $checkinRepo)
    {
        $this->checkinRepository = $checkinRepo;
    }

    /**
     * Display a listing of the Checkin.
     * GET|HEAD /checkins
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $checkins = $this->checkinRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($checkins->toArray(), 'Checkins retrieved successfully');
    }

    /**
     * Store a newly created Checkin in storage.
     * POST /checkins
     *
     * @param CreateCheckinAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCheckinAPIRequest $request)
    {
        $input = $request->all();

        $checkin = $this->checkinRepository->create($input);

        return $this->sendResponse($checkin->toArray(), 'Checkin saved successfully');
    }

    /**
     * Display the specified Checkin.
     * GET|HEAD /checkins/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Checkin $checkin */
        $checkin = $this->checkinRepository->find($id);

        if (empty($checkin)) {
            return $this->sendError('Checkin not found');
        }

        return $this->sendResponse($checkin->toArray(), 'Checkin retrieved successfully');
    }

    /**
     * Update the specified Checkin in storage.
     * PUT/PATCH /checkins/{id}
     *
     * @param int $id
     * @param UpdateCheckinAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCheckinAPIRequest $request)
    {
        $input = $request->all();

        /** @var Checkin $checkin */
        $checkin = $this->checkinRepository->find($id);

        if (empty($checkin)) {
            return $this->sendError('Checkin not found');
        }

        $checkin = $this->checkinRepository->update($input, $id);

        return $this->sendResponse($checkin->toArray(), 'Checkin updated successfully');
    }

    /**
     * Remove the specified Checkin from storage.
     * DELETE /checkins/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Checkin $checkin */
        $checkin = $this->checkinRepository->find($id);

        if (empty($checkin)) {
            return $this->sendError('Checkin not found');
        }

        $checkin->delete();

        return $this->sendSuccess('Checkin deleted successfully');
    }
}
