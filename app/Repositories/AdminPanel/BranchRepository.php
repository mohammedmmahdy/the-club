<?php

namespace App\Repositories\AdminPanel;

use App\Models\Branch;
use App\Repositories\BaseRepository;

/**
 * Class BranchRepository
 * @package App\Repositories\AdminPanel
 * @version September 13, 2021, 10:49 am UTC
*/

class BranchRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'address'
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
        return Branch::class;
    }
}
