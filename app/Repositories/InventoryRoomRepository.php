<?php

namespace App\Repositories;

use App\Models\InventoryRoom;
use App\Repositories\BaseRepository;

/**
 * Class InventoryRoomRepository
 * @package App\Repositories
 * @version October 25, 2023, 9:13 am UTC
*/

class InventoryRoomRepository extends BaseRepository
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
        return InventoryRoom::class;
    }
}
