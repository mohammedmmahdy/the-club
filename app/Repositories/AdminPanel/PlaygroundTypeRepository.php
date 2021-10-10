<?php

namespace App\Repositories\AdminPanel;

use App\Models\PlaygroundType;
use App\Repositories\BaseRepository;

/**
 * Class PlaygroundTypeRepository
 * @package App\Repositories\AdminPanel
 * @version October 7, 2021, 9:55 am UTC
*/

class PlaygroundTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return PlaygroundType::class;
    }
}
