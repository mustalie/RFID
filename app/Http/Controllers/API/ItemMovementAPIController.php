<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateItemMovementAPIRequest;
use App\Http\Requests\API\UpdateItemMovementAPIRequest;
use App\Models\ItemMovement;
use App\Repositories\ItemMovementRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Mail\ItemOut;
use App\Models\DeviceRoom;
use App\Models\InventoryDetail;
use App\Models\Persediaan;
use App\Models\Tag;
use App\Models\TagMap;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Response;

/**
 * Class ItemMovementController
 * @package App\Http\Controllers\API
 */

class ItemMovementAPIController extends AppBaseController
{
    /** @var  ItemMovementRepository */
    private $itemMovementRepository;

    public function __construct(ItemMovementRepository $itemMovementRepo)
    {
        $this->itemMovementRepository = $itemMovementRepo;
    }

    /**
     * Display a listing of the ItemMovement.
     * GET|HEAD /itemMovements
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $itemMovements = $this->itemMovementRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($itemMovements->toArray(), 'Item Movements retrieved successfully');
    }

    /**
     * Store a newly created ItemMovement in storage.
     * POST /itemMovements
     *
     * @param CreateItemMovementAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateItemMovementAPIRequest $request)
    {
        $input = $request->all();

        $itemMovement = $this->itemMovementRepository->create($input);

        return $this->sendResponse($itemMovement->toArray(), 'Item Movement saved successfully');
    }

    /**
     * Display the specified ItemMovement.
     * GET|HEAD /itemMovements/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ItemMovement $itemMovement */
        $itemMovement = $this->itemMovementRepository->find($id);

        if (empty($itemMovement)) {
            return $this->sendError('Item Movement not found');
        }

        return $this->sendResponse($itemMovement->toArray(), 'Item Movement retrieved successfully');
    }

    /**
     * Update the specified ItemMovement in storage.
     * PUT/PATCH /itemMovements/{id}
     *
     * @param int $id
     * @param UpdateItemMovementAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItemMovementAPIRequest $request)
    {
        $input = $request->all();

        /** @var ItemMovement $itemMovement */
        $itemMovement = $this->itemMovementRepository->find($id);

        if (empty($itemMovement)) {
            return $this->sendError('Item Movement not found');
        }

        $itemMovement = $this->itemMovementRepository->update($input, $id);

        return $this->sendResponse($itemMovement->toArray(), 'ItemMovement updated successfully');
    }

    /**
     * Remove the specified ItemMovement from storage.
     * DELETE /itemMovements/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ItemMovement $itemMovement */
        $itemMovement = $this->itemMovementRepository->find($id);

        if (empty($itemMovement)) {
            return $this->sendError('Item Movement not found');
        }

        $itemMovement->delete();

        return $this->sendSuccess('Item Movement deleted successfully');
    }

    public function submit(Request $request)
    {
        $tag = $request->input('tag');
        $device_id = $request->input('device_id');
        $antenna = $request->input('antenna');

        $tag = Tag::with('tagMap')->where('tag', $tag)->first();
            
        if (empty($tag) || empty($tag->tagMap)) {
            return $this->sendError('Invalid tag');
        }

        $deviceRoom = DeviceRoom::with('room')
            ->where('device_id', $device_id)
            ->where('antenna', $antenna)
            ->first();

        if (empty($deviceRoom) || empty($deviceRoom->room)) {
            return $this->sendError('Device belum diregistrasi');
        }

        $prev_tag = ItemMovement::where('tag_id', $tag->id)
            ->where('created_at', '>=', Carbon::now()->subMinutes(5)->toDateTimeString())
            ->orderBy('created_at', 'DESC')
            ->first();

        if (!empty($prev_tag)) {
            return $this->sendError('There is already registered movement within 5 minutes');
        }

        $itemMovement = new ItemMovement;
        $itemMovement->tag_id = $tag->id;
        $itemMovement->room_id = $deviceRoom->room_id;
        $itemMovement->save();

        if($tag->tagMap->item_type == TagMap::TYPE_INVENTORY) {
            $tag->tagMap->load('inventory');
            $inventory = $tag->tagMap->inventory;

            if(!empty($inventory)) {
                $inventoryDetail = InventoryDetail::with('group', 'room')
                    ->where('ACC', $inventory->ACC)
                    ->first();

                if(!empty($inventoryDetail)) {
                    // barang keluar
                    if($inventoryDetail->room_id == $deviceRoom->room_id) {
                        if(!empty($inventoryDetail->group) && $inventoryDetail->group->required_permission) {
                            Mail::to(config('MAIL_NOTIF_TO'))->send(new ItemOut($itemMovement));
                        }
                    }
                    else { // barang masuk
                        $inventoryDetail->room_id = $deviceRoom->room_id;
                        $inventoryDetail->save();
                    }
                }
            }
        }

        return $this->sendResponse([], 'Item Movement saved successfully');
    }
}
