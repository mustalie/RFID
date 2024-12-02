<?php

namespace App\Repositories;

use App\Models\ItemMovement;
use App\Repositories\BaseRepository;

/**
 * Class ItemMovementRepository
 * @package App\Repositories
 * @version October 18, 2023, 8:35 am UTC
*/

class ItemMovementRepository extends BaseRepository
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
        return ItemMovement::class;
    }
}
