<?php

namespace App\Repositories\AdminPanel;

use App\Models\News;
use App\Repositories\BaseRepository;

/**
 * Class NewsRepository
 * @package App\Repositories\AdminPanel
 * @version December 6, 2021, 11:37 am UTC
*/

class NewsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'photo',
        'title',
        'body'
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
        return News::class;
    }
}
