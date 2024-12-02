<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStudentPresenceAPIRequest;
use App\Http\Requests\API\UpdateStudentPresenceAPIRequest;
use App\Models\StudentPresence;
use App\Repositories\StudentPresenceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\Tag;
use App\Models\TagMap;
use Response;

/**
 * Class StudentPresenceController
 * @package App\Http\Controllers\API
 */

class StudentPresenceAPIController extends AppBaseController
{
    /** @var  StudentPresenceRepository */
    private $studentPresenceRepository;

    public function __construct(StudentPresenceRepository $studentPresenceRepo)
    {
        $this->studentPresenceRepository = $studentPresenceRepo;
    }

    /**
     * Display a listing of the StudentPresence.
     * GET|HEAD /studentPresences
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $studentPresences = $this->studentPresenceRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($studentPresences->toArray(), 'Student Presences retrieved successfully');
    }

    public function submit(Request $request) {
        $tags = $request->input('tags');
        $room_id = $request->input('room_id');

        $tags = explode(',', $tags);
        $tags = Tag::with('tagMap', 'tagMap.student')
                ->whereHas('tagMap', function($query){
                    $query->where('item_type', TagMap::TYPE_STUDENT);
                })
                ->whereIn('tag', $tags)
                ->get();

        foreach($tags as $tag) {
            $presence = new StudentPresence;
            $presence->nim = $tag->tagMap->student->NIM;
            $presence->room_id = $room_id;
            $presence->save();
        }

        return $this->sendResponse([], 'Data have been saved');
    }

    /**
     * Store a newly created StudentPresence in storage.
     * POST /studentPresences
     *
     * @param CreateStudentPresenceAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateStudentPresenceAPIRequest $request)
    {
        $input = $request->all();

        $studentPresence = $this->studentPresenceRepository->create($input);

        return $this->sendResponse($studentPresence->toArray(), 'Student Presence saved successfully');
    }

    /**
     * Display the specified StudentPresence.
     * GET|HEAD /studentPresences/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var StudentPresence $studentPresence */
        $studentPresence = $this->studentPresenceRepository->find($id);

        if (empty($studentPresence)) {
            return $this->sendError('Student Presence not found');
        }

        return $this->sendResponse($studentPresence->toArray(), 'Student Presence retrieved successfully');
    }

    /**
     * Update the specified StudentPresence in storage.
     * PUT/PATCH /studentPresences/{id}
     *
     * @param int $id
     * @param UpdateStudentPresenceAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStudentPresenceAPIRequest $request)
    {
        $input = $request->all();

        /** @var StudentPresence $studentPresence */
        $studentPresence = $this->studentPresenceRepository->find($id);

        if (empty($studentPresence)) {
            return $this->sendError('Student Presence not found');
        }

        $studentPresence = $this->studentPresenceRepository->update($input, $id);

        return $this->sendResponse($studentPresence->toArray(), 'StudentPresence updated successfully');
    }

    /**
     * Remove the specified StudentPresence from storage.
     * DELETE /studentPresences/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var StudentPresence $studentPresence */
        $studentPresence = $this->studentPresenceRepository->find($id);

        if (empty($studentPresence)) {
            return $this->sendError('Student Presence not found');
        }

        $studentPresence->delete();

        return $this->sendSuccess('Student Presence deleted successfully');
    }
}
