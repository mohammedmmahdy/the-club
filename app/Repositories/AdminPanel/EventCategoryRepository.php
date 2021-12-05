<?php

namespace App\Repositories\AdminPanel;

use App\Models\EventCategory;
use App\Repositories\BaseRepository;

/**
 * Class EventCategoryRepository
 * @package App\Repositories\AdminPanel
 * @version December 5, 2021, 12:11 pm UTC
*/

class EventCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'price'
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
        return EventCategory::class;
    }
}
