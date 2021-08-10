<?php

namespace App\Repositories\AdminPanel;

use App\Models\Slider;
use App\Repositories\BaseRepository;

/**
 * Class SliderRepository
 * @package App\Repositories\AdminPanel
 * @version June 4, 2020, 12:06 pm UTC
*/

class SliderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'photo',
        'title',
        'description',
        'link',
        'status',
        'sort'
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
        return Slider::class;
    }
}
