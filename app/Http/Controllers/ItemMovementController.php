<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateItemMovementRequest;
use App\Http\Requests\UpdateItemMovementRequest;
use App\Repositories\ItemMovementRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ItemMovementController extends AppBaseController
{
    /** @var ItemMovementRepository $itemMovementRepository*/
    private $itemMovementRepository;

    public function __construct(ItemMovementRepository $itemMovementRepo)
    {
        $this->itemMovementRepository = $itemMovementRepo;
    }

    /**
     * Display a listing of the ItemMovement.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $itemMovements = $this->itemMovementRepository->all();

        return view('item_movements.index')
            ->with('itemMovements', $itemMovements);
    }

    /**
     * Show the form for creating a new ItemMovement.
     *
     * @return Response
     */
    public function create()
    {
        return view('item_movements.create');
    }

    /**
     * Store a newly created ItemMovement in storage.
     *
     * @param CreateItemMovementRequest $request
     *
     * @return Response
     */
    public function store(CreateItemMovementRequest $request)
    {
        $input = $request->all();

        $itemMovement = $this->itemMovementRepository->create($input);

        Flash::success('Item Movement saved successfully.');

        return redirect(route('itemMovements.index'));
    }

    /**
     * Display the specified ItemMovement.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $itemMovement = $this->itemMovementRepository->find($id);

        if (empty($itemMovement)) {
            Flash::error('Item Movement not found');

            return redirect(route('itemMovements.index'));
        }

        return view('item_movements.show')->with('itemMovement', $itemMovement);
    }

    /**
     * Show the form for editing the specified ItemMovement.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $itemMovement = $this->itemMovementRepository->find($id);

        if (empty($itemMovement)) {
            Flash::error('Item Movement not found');

            return redirect(route('itemMovements.index'));
        }

        return view('item_movements.edit')->with('itemMovement', $itemMovement);
    }

    /**
     * Update the specified ItemMovement in storage.
     *
     * @param int $id
     * @param UpdateItemMovementRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItemMovementRequest $request)
    {
        $itemMovement = $this->itemMovementRepository->find($id);

        if (empty($itemMovement)) {
            Flash::error('Item Movement not found');

            return redirect(route('itemMovements.index'));
        }

        $itemMovement = $this->itemMovementRepository->update($request->all(), $id);

        Flash::success('Item Movement updated successfully.');

        return redirect(route('itemMovements.index'));
    }

    /**
     * Remove the specified ItemMovement from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $itemMovement = $this->itemMovementRepository->find($id);

        if (empty($itemMovement)) {
            Flash::error('Item Movement not found');

            return redirect(route('itemMovements.index'));
        }

        $this->itemMovementRepository->delete($id);

        Flash::success('Item Movement deleted successfully.');

        return redirect(route('itemMovements.index'));
    }
}
