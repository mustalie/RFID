<?php

namespace App\Repositories;

use App\Models\InventoryDetail;
use App\Repositories\BaseRepository;

/**
 * Class InventoryDetailRepository
 * @package App\Repositories
 * @version October 26, 2023, 2:08 am UTC
*/

class InventoryDetailRepository extends BaseRepository
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
        return InventoryDetail::class;
    }
}
