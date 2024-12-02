<?php

namespace App\Repositories;

use App\Models\StudentPresence;
use App\Repositories\BaseRepository;

/**
 * Class StudentPresenceRepository
 * @package App\Repositories
 * @version October 18, 2023, 4:15 am UTC
*/

class StudentPresenceRepository extends BaseRepository
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
        return StudentPresence::class;
    }
}
