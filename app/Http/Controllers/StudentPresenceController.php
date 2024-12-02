<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentPresenceRequest;
use App\Http\Requests\UpdateStudentPresenceRequest;
use App\Repositories\StudentPresenceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class StudentPresenceController extends AppBaseController
{
    /** @var StudentPresenceRepository $studentPresenceRepository*/
    private $studentPresenceRepository;

    public function __construct(StudentPresenceRepository $studentPresenceRepo)
    {
        $this->studentPresenceRepository = $studentPresenceRepo;
    }

    /**
     * Display a listing of the StudentPresence.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $studentPresences = $this->studentPresenceRepository->all();

        return view('student_presences.index')
            ->with('studentPresences', $studentPresences);
    }

    /**
     * Show the form for creating a new StudentPresence.
     *
     * @return Response
     */
    public function create()
    {
        return view('student_presences.create');
    }

    /**
     * Store a newly created StudentPresence in storage.
     *
     * @param CreateStudentPresenceRequest $request
     *
     * @return Response
     */
    public function store(CreateStudentPresenceRequest $request)
    {
        $input = $request->all();

        $studentPresence = $this->studentPresenceRepository->create($input);

        Flash::success('Student Presence saved successfully.');

        return redirect(route('studentPresences.index'));
    }

    /**
     * Display the specified StudentPresence.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $studentPresence = $this->studentPresenceRepository->find($id);

        if (empty($studentPresence)) {
            Flash::error('Student Presence not found');

            return redirect(route('studentPresences.index'));
        }

        return view('student_presences.show')->with('studentPresence', $studentPresence);
    }

    /**
     * Show the form for editing the specified StudentPresence.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $studentPresence = $this->studentPresenceRepository->find($id);

        if (empty($studentPresence)) {
            Flash::error('Student Presence not found');

            return redirect(route('studentPresences.index'));
        }

        return view('student_presences.edit')->with('studentPresence', $studentPresence);
    }

    /**
     * Update the specified StudentPresence in storage.
     *
     * @param int $id
     * @param UpdateStudentPresenceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStudentPresenceRequest $request)
    {
        $studentPresence = $this->studentPresenceRepository->find($id);

        if (empty($studentPresence)) {
            Flash::error('Student Presence not found');

            return redirect(route('studentPresences.index'));
        }

        $studentPresence = $this->studentPresenceRepository->update($request->all(), $id);

        Flash::success('Student Presence updated successfully.');

        return redirect(route('studentPresences.index'));
    }

    /**
     * Remove the specified StudentPresence from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $studentPresence = $this->studentPresenceRepository->find($id);

        if (empty($studentPresence)) {
            Flash::error('Student Presence not found');

            return redirect(route('studentPresences.index'));
        }

        $this->studentPresenceRepository->delete($id);

        Flash::success('Student Presence deleted successfully.');

        return redirect(route('studentPresences.index'));
    }
}
