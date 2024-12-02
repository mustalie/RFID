<?php

namespace App\Repositories;

use App\Models\DeviceRoom;
use App\Repositories\BaseRepository;

/**
 * Class DeviceRoomRepository
 * @package App\Repositories
 * @version October 25, 2023, 3:34 am UTC
*/

class DeviceRoomRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DeviceRoom::class;
    }
}
