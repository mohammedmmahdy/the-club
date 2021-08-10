<?php

namespace App\Repositories\AdminPanel;

use App\Models\Admin;
use App\Repositories\BaseRepository;

/**
 * Class AdminRepository
 * @package App\Repositories\AdminPanel
 * @version March 28, 2021, 12:25 pm UTC
*/

class AdminRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'status'
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
        return Admin::class;
    }
}
