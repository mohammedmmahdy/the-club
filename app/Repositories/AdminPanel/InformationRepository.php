<?php

namespace App\Repositories\AdminPanel;

use App\Models\Information;
use App\Repositories\BaseRepository;

/**
 * Class InformationRepository
 * @package App\Repositories\AdminPanel
 * @version June 4, 2020, 11:51 am UTC
*/

class InformationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'value',
        'status'
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
        return Information::class;
    }
}
