<?php

namespace App\Repositories\AdminPanel;

use App\Models\Blog;
use App\Repositories\BaseRepository;

/**
 * Class BlogRepository
 * @package App\Repositories\AdminPanel
 * @version February 25, 2021, 12:16 pm EET
*/

class BlogRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return Blog::class;
    }
}
