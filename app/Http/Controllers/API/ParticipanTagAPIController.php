<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\ParticipanTag;

/**
 * Class RoomController
 * @package App\Http\Controllers\API
 */

class ParticipanTagAPIController extends AppBaseController
{
  public function store (Request $request) {
    $data=ParticipanTag::insert([
        "tag"=> $request->tag, 
        "name"=> $request->name
    ]);
    return $this->sendResponse($data, 'Data retrieved successfully');
  }
  

   

   
}
