<?php

namespace App\Repositories;

use App\Models\Checkin;
use App\Repositories\BaseRepository;

/**
 * Class CheckinRepository
 * @package App\Repositories
 * @version October 18, 2023, 3:22 am UTC
*/

class CheckinRepository extends BaseRepository
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
        return Checkin::class;
    }
}
