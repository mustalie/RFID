<?php

namespace App\Repositories;

use App\Models\TagMap;
use App\Repositories\BaseRepository;

/**
 * Class TagMapRepository
 * @package App\Repositories
 * @version October 18, 2023, 3:14 am UTC
*/

class TagMapRepository extends BaseRepository
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
        return TagMap::class;
    }
}
