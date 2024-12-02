<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\Persediaan;
use Response;

/**
 * Class TagController
 * @package App\Http\Controllers\API
 */

class PersediaanAPIController extends AppBaseController
{
    public function autocomplete(Request $request) {
        $query = $request->input('query');
        $persediaans = Persediaan::where('ACC', 'LIKE', "%{$query}%")
            ->orWhere('KETER', 'LIKE', "%{$query}%")
            ->get();
        $data = array();

        foreach($persediaans as $persediaan) {
            $data[] = [
                'id' => $persediaan->ACC,
                'name' => $persediaan->KETER// ." (".$persediaan->ACC.")"
            ];
        }
        

        return $this->sendResponse($data, 'Data retrieved successfully');
    }
}