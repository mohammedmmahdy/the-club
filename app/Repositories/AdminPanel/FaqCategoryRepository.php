<?php

namespace App\Repositories;

use App\Models\FaqCategory;
use App\Repositories\BaseRepository;

/**
 * Class FaqCategoryRepository
 * @package App\Repositories
 * @version December 8, 2020, 3:09 pm UTC
*/

class FaqCategoryRepository extends BaseRepository
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
        return FaqCategory::class;
    }
}
