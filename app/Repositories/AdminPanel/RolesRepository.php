<?php

namespace App\Repositories\AdminPanel;

use Spatie\Permission\Models\Role;
// use App\Models\Roles;
use App\Repositories\BaseRepository;

/**
 * Class RolesRepository
 * @package App\Repositories\AdminPanel
 * @version December 23, 2019, 3:07 pm UTC
*/

class RolesRepository extends BaseRepository
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
        return Role::class;
    }
}
