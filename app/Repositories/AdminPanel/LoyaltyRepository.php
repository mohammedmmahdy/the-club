<?php

namespace App\Repositories\AdminPanel;

use App\Models\Loyalty;
use App\Repositories\BaseRepository;

/**
 * Class LoyaltyRepository
 * @package App\Repositories\AdminPanel
 * @version February 16, 2022, 3:16 pm EET
*/

class LoyaltyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'photo',
        'discount_value',
        'title',
        'brief',
        'description'
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
        return Loyalty::class;
    }
}
