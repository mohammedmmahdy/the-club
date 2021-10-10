<?php

namespace App\Repositories\AdminPanel;

use App\Models\Academy;
use App\Repositories\BaseRepository;

/**
 * Class AcademyRepository
 * @package App\Repositories\AdminPanel
 * @version September 13, 2021, 1:22 pm UTC
*/

class AcademyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'branch_id',
        'name',
        'about',
        'team',
        'icon'
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
        return Academy::class;
    }
}
