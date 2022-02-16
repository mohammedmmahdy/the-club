<?php

namespace App\Repositories\AdminPanel;

use App\Models\Onboarding;
use App\Repositories\BaseRepository;

/**
 * Class OnboardingRepository
 * @package App\Repositories\AdminPanel
 * @version December 27, 2021, 9:02 am UTC
*/

class OnboardingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'text',
        'photo'
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
        return Onboarding::class;
    }
}
