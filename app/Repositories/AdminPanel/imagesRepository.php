<?php

namespace App\Repositories\AdminPanel;

use App\Models\Images;
use App\Repositories\BaseRepository;

/**
 * Class imagesRepository
 * @package App\Repositories\AdminPanel
 * @version September 27, 2020, 12:25 pm UTC
 */

class imagesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'page_id',
        'photo'
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
        return images::class;
    }
}
