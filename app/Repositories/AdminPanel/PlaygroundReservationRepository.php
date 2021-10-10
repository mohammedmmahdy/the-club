<?php

namespace App\Repositories\AdminPanel;

use App\Models\PlaygroundReservation;
use App\Repositories\BaseRepository;

/**
 * Class PlaygroundReservationRepository
 * @package App\Repositories\AdminPanel
 * @version October 7, 2021, 10:21 am UTC
*/

class PlaygroundReservationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'playground_id',
        'date',
        'time',
        'number_of_people'
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
        return PlaygroundReservation::class;
    }
}
