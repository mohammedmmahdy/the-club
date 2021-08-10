<?php

namespace App\Repositories\AdminPanel;

use App\Models\Notification;
use App\Repositories\BaseRepository;

/**
 * Class NotificationRepository
 * @package App\Repositories\AdminPanel
 * @version May 31, 2021, 12:18 pm UTC
*/

class NotificationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'brief',
        'description',
        'btn_to',
        'photo',
        'type'
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
        return Notification::class;
    }
}
