<?php

namespace App\Repositories\AdminPanel;

use App\Models\Paragraph;
use App\Repositories\BaseRepository;

/**
 * Class ParagraphRepository
 * @package App\Repositories\AdminPanel
 * @version September 27, 2020, 12:24 pm UTC
*/

class ParagraphRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'page_id',
        'text'
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
        return Paragraph::class;
    }
}
