<?php

namespace App\Repositories\AdminPanel;

use App\Models\OfferCategory;
use App\Repositories\BaseRepository;

/**
 * Class OfferCategoryRepository
 * @package App\Repositories\AdminPanel
 * @version December 29, 2021, 11:23 am UTC
*/

class OfferCategoryRepository extends BaseRepository
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
        return OfferCategory::class;
    }
}
