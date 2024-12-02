<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\Mahasiswa;
use Response;

/**
 * Class TagController
 * @package App\Http\Controllers\API
 */

class MahasiswaAPIController extends AppBaseController
{
    public function autocomplete(Request $request) {
        $query = $request->input('query');
        $mahasiswas = Mahasiswa::where('NIM', 'LIKE', "%{$query}%")
            ->orWhere('FullName', 'LIKE', "%{$query}%")
            ->get();
        $data = array();

        foreach($mahasiswas as $mahasiswa) {
            $data[] = [
                'id' => $mahasiswa->NIM,
                'name' => $mahasiswa->FullName// ." (".$mahasiswa->NIM.")"
            ];
        }
        

        return $this->sendResponse($data, 'Data retrieved successfully');
    }
}