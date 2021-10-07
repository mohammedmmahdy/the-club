<?php

namespace App\Repositories\AdminPanel;

use App\Models\Playground;
use App\Repositories\BaseRepository;

/**
 * Class PlaygroundRepository
 * @package App\Repositories\AdminPanel
 * @version October 7, 2021, 10:16 am UTC
*/

class PlaygroundRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type_id',
        'name',
        'description'
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
        return Playground::class;
    }
}
