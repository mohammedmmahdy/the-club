<?php

namespace App\Repositories;

use App\Models\Faq;
use App\Repositories\BaseRepository;

/**
 * Class FaqRepository
 * @package App\Repositories
 * @version December 8, 2020, 3:10 pm UTC
*/

class FaqRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'question',
        'answer'
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
        return Faq::class;
    }
}
