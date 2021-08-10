<?php

namespace App\Repositories\AdminPanel;

use App\Models\Option;
use App\Repositories\BaseRepository;

/**
 * Class OptionRepository
 * @package App\Repositories\AdminPanel
 * @version April 20, 2021, 9:38 am UTC
*/

class OptionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'min_model_year'
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
        return Option::class;
    }
}
