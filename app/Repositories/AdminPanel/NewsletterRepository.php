<?php

namespace App\Repositories\AdminPanel;

use App\Models\Newsletter;
use App\Repositories\BaseRepository;

/**
 * Class NewsletterRepository
 * @package App\Repositories\AdminPanel
 * @version June 7, 2020, 7:21 am UTC
*/

class NewsletterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'email'
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
        return Newsletter::class;
    }
}
