<?php

namespace App\Repositories\AdminPanel;

use App\Models\Champ;
use App\Repositories\BaseRepository;

/**
 * Class ChampRepository
 * @package App\Repositories\AdminPanel
 * @version February 20, 2022, 11:55 am EET
*/

class ChampRepository extends BaseRepository
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
        return Champ::class;
    }
}
