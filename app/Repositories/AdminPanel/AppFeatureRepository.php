<?php

namespace App\Repositories\AdminPanel;

use App\Models\AppFeature;
use App\Repositories\BaseRepository;

/**
 * Class AppFeatureRepository
 * @package App\Repositories\AdminPanel
 * @version April 4, 2021, 3:31 pm UTC
*/

class AppFeatureRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'icon'
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
        return AppFeature::class;
    }
}
