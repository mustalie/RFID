<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInventoryGroupRequest;
use App\Http\Requests\UpdateInventoryGroupRequest;
use App\Repositories\InventoryGroupRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class InventoryGroupController extends AppBaseController
{
    /** @var InventoryGroupRepository $inventoryGroupRepository*/
    private $inventoryGroupRepository;

    public function __construct(InventoryGroupRepository $inventoryGroupRepo)
    {
        $this->inventoryGroupRepository = $inventoryGroupRepo;
    }

    /**
     * Display a listing of the InventoryGroup.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $inventoryGroups = $this->inventoryGroupRepository->all();

        return view('inventory_groups.index')
            ->with('inventoryGroups', $inventoryGroups);
    }

    /**
     * Show the form for creating a new InventoryGroup.
     *
     * @return Response
     */
    public function create()
    {
        return view('inventory_groups.create');
    }

    /**
     * Store a newly created InventoryGroup in storage.
     *
     * @param CreateInventoryGroupRequest $request
     *
     * @return Response
     */
    public function store(CreateInventoryGroupRequest $request)
    {
        $input = $request->all();

        $inventoryGroup = $this->inventoryGroupRepository->create($input);

        Flash::success('Inventory Group saved successfully.');

        return redirect(route('inventoryGroups.index'));
    }

    /**
     * Display the specified InventoryGroup.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $inventoryGroup = $this->inventoryGroupRepository->find($id);

        if (empty($inventoryGroup)) {
            Flash::error('Inventory Group not found');

            return redirect(route('inventoryGroups.index'));
        }

        return view('inventory_groups.show')->with('inventoryGroup', $inventoryGroup);
    }

    /**
     * Show the form for editing the specified InventoryGroup.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $inventoryGroup = $this->inventoryGroupRepository->find($id);

        if (empty($inventoryGroup)) {
            Flash::error('Inventory Group not found');

            return redirect(route('inventoryGroups.index'));
        }

        return view('inventory_groups.edit')->with('inventoryGroup', $inventoryGroup);
    }

    /**
     * Update the specified InventoryGroup in storage.
     *
     * @param int $id
     * @param UpdateInventoryGroupRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInventoryGroupRequest $request)
    {
        $inventoryGroup = $this->inventoryGroupRepository->find($id);

        if (empty($inventoryGroup)) {
            Flash::error('Inventory Group not found');

            return redirect(route('inventoryGroups.index'));
        }

        $inventoryGroup = $this->inventoryGroupRepository->update($request->all(), $id);

        Flash::success('Inventory Group updated successfully.');

        return redirect(route('inventoryGroups.index'));
    }

    /**
     * Remove the specified InventoryGroup from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inventoryGroup = $this->inventoryGroupRepository->find($id);

        if (empty($inventoryGroup)) {
            Flash::error('Inventory Group not found');

            return redirect(route('inventoryGroups.index'));
        }

        $this->inventoryGroupRepository->delete($id);

        Flash::success('Inventory Group deleted successfully.');

        return redirect(route('inventoryGroups.index'));
    }
}
