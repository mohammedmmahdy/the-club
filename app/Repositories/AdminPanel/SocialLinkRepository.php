<?php

namespace App\Repositories\AdminPanel;

use App\Models\SocialLink;
use App\Repositories\BaseRepository;

/**
 * Class SocialLinkRepository
 * @package App\Repositories\AdminPanel
 * @version October 1, 2020, 8:00 am UTC
*/

class SocialLinkRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'link',
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
        return SocialLink::class;
    }
}
