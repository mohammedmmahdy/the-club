<?php

namespace App\Repositories\AdminPanel;

use App\Models\Offer;
use App\Repositories\BaseRepository;

/**
 * Class OfferRepository
 * @package App\Repositories\AdminPanel
 * @version December 29, 2021, 11:26 am UTC
*/

class OfferRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'photo',
        'description',
        'discount_value',
        'offer_category_id'
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
        return Offer::class;
    }
}
