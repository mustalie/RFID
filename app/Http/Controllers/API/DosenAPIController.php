<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\Dosen;
use Response;

/**
 * Class TagController
 * @package App\Http\Controllers\API
 */

class DosenAPIController extends AppBaseController
{
    public function autocomplete(Request $request) {
        $query = $request->input('query');
        $dosens = Dosen::where('NID', 'LIKE', "%{$query}%")
            ->orWhere('FullName', 'LIKE', "%{$query}%")
            ->get();
        $data = array();

        foreach($dosens as $dosen) {
            $data[] = [
                'id' => $dosen->NID,
                'name' => $dosen->FullName// ." (".$dosen->NID.")"
            ];
        }
        

        return $this->sendResponse($data, 'Data retrieved successfully');
    }
}