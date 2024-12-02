<?php

namespace App\Repositories;

use App\Models\InventoryGroup;
use App\Repositories\BaseRepository;

/**
 * Class InventoryGroupRepository
 * @package App\Repositories
 * @version October 26, 2023, 2:08 am UTC
*/

class InventoryGroupRepository extends BaseRepository
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
        return InventoryGroup::class;
    }
}
