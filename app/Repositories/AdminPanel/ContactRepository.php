<?php

namespace App\Repositories\AdminPanel;

use App\Models\Contact;
use App\Repositories\BaseRepository;

/**
 * Class ContactRepository
 * @package App\Repositories\AdminPanel
 * @version June 7, 2020, 7:21 am UTC
*/

class ContactRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'subject',
        'message'
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
        return Contact::class;
    }
}
