<?php

namespace App\Repositories\AdminPanel;

use App\Models\TicketReservation;
use App\Repositories\BaseRepository;

/**
 * Class TicketReservationRepository
 * @package App\Repositories\AdminPanel
 * @version October 14, 2021, 11:30 am UTC
*/

class TicketReservationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'date',
        'number_of_people',
        'price'
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
        return TicketReservation::class;
    }
}
