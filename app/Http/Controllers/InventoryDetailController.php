<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInventoryDetailRequest;
use App\Http\Requests\UpdateInventoryDetailRequest;
use App\Repositories\InventoryDetailRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class InventoryDetailController extends AppBaseController
{
    /** @var InventoryDetailRepository $inventoryDetailRepository*/
    private $inventoryDetailRepository;

    public function __construct(InventoryDetailRepository $inventoryDetailRepo)
    {
        $this->inventoryDetailRepository = $inventoryDetailRepo;
    }

    /**
     * Display a listing of the InventoryDetail.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $inventoryDetails = $this->inventoryDetailRepository->all();

        return view('inventory_details.index')
            ->with('inventoryDetails', $inventoryDetails);
    }

    /**
     * Show the form for creating a new InventoryDetail.
     *
     * @return Response
     */
    public function create()
    {
        return view('inventory_details.create');
    }

    /**
     * Store a newly created InventoryDetail in storage.
     *
     * @param CreateInventoryDetailRequest $request
     *
     * @return Response
     */
    public function store(CreateInventoryDetailRequest $request)
    {
        $input = $request->all();

        $inventoryDetail = $this->inventoryDetailRepository->create($input);

        Flash::success('Inventory Detail saved successfully.');

        return redirect(route('inventoryDetails.index'));
    }

    /**
     * Display the specified InventoryDetail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $inventoryDetail = $this->inventoryDetailRepository->find($id);

        if (empty($inventoryDetail)) {
            Flash::error('Inventory Detail not found');

            return redirect(route('inventoryDetails.index'));
        }

        return view('inventory_details.show')->with('inventoryDetail', $inventoryDetail);
    }

    /**
     * Show the form for editing the specified InventoryDetail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $inventoryDetail = $this->inventoryDetailRepository->find($id);

        if (empty($inventoryDetail)) {
            Flash::error('Inventory Detail not found');

            return redirect(route('inventoryDetails.index'));
        }

        return view('inventory_details.edit')->with('inventoryDetail', $inventoryDetail);
    }

    /**
     * Update the specified InventoryDetail in storage.
     *
     * @param int $id
     * @param UpdateInventoryDetailRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInventoryDetailRequest $request)
    {
        $inventoryDetail = $this->inventoryDetailRepository->find($id);

        if (empty($inventoryDetail)) {
            Flash::error('Inventory Detail not found');

            return redirect(route('inventoryDetails.index'));
        }

        $inventoryDetail = $this->inventoryDetailRepository->update($request->all(), $id);

        Flash::success('Inventory Detail updated successfully.');

        return redirect(route('inventoryDetails.index'));
    }

    /**
     * Remove the specified InventoryDetail from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inventoryDetail = $this->inventoryDetailRepository->find($id);

        if (empty($inventoryDetail)) {
            Flash::error('Inventory Detail not found');

            return redirect(route('inventoryDetails.index'));
        }

        $this->inventoryDetailRepository->delete($id);

        Flash::success('Inventory Detail deleted successfully.');

        return redirect(route('inventoryDetails.index'));
    }
}
