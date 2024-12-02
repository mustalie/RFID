<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTagMapRequest;
use App\Http\Requests\UpdateTagMapRequest;
use App\Repositories\TagMapRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TagMapController extends AppBaseController
{
    /** @var TagMapRepository $tagMapRepository*/
    private $tagMapRepository;

    public function __construct(TagMapRepository $tagMapRepo)
    {
        $this->tagMapRepository = $tagMapRepo;
    }

    /**
     * Display a listing of the TagMap.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tagMaps = $this->tagMapRepository->all();

        return view('tag_maps.index')
            ->with('tagMaps', $tagMaps);
    }

    /**
     * Show the form for creating a new TagMap.
     *
     * @return Response
     */
    public function create()
    {
        return view('tag_maps.create');
    }

    /**
     * Store a newly created TagMap in storage.
     *
     * @param CreateTagMapRequest $request
     *
     * @return Response
     */
    public function store(CreateTagMapRequest $request)
    {
        $input = $request->all();

        $tagMap = $this->tagMapRepository->create($input);

        Flash::success('Tag Map saved successfully.');

        return redirect(route('tagMaps.index'));
    }

    /**
     * Display the specified TagMap.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tagMap = $this->tagMapRepository->find($id);

        if (empty($tagMap)) {
            Flash::error('Tag Map not found');

            return redirect(route('tagMaps.index'));
        }

        return view('tag_maps.show')->with('tagMap', $tagMap);
    }

    /**
     * Show the form for editing the specified TagMap.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tagMap = $this->tagMapRepository->find($id);

        if (empty($tagMap)) {
            Flash::error('Tag Map not found');

            return redirect(route('tagMaps.index'));
        }

        return view('tag_maps.edit')->with('tagMap', $tagMap);
    }

    /**
     * Update the specified TagMap in storage.
     *
     * @param int $id
     * @param UpdateTagMapRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTagMapRequest $request)
    {
        $tagMap = $this->tagMapRepository->find($id);

        if (empty($tagMap)) {
            Flash::error('Tag Map not found');

            return redirect(route('tagMaps.index'));
        }

        $tagMap = $this->tagMapRepository->update($request->all(), $id);

        Flash::success('Tag Map updated successfully.');

        return redirect(route('tagMaps.index'));
    }

    /**
     * Remove the specified TagMap from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tagMap = $this->tagMapRepository->find($id);

        if (empty($tagMap)) {
            Flash::error('Tag Map not found');

            return redirect(route('tagMaps.index'));
        }

        $this->tagMapRepository->delete($id);

        Flash::success('Tag Map deleted successfully.');

        return redirect(route('tagMaps.index'));
    }
}
