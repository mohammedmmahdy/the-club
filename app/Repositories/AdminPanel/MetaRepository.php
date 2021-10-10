<?php

namespace App\Repositories\AdminPanel;

use App\Models\Meta;
use App\Models\MetaTranslation;
use App\Repositories\BaseRepository;

/**
 * Class MetaRepository
 * @package App\Repositories\AdminPanel
 * @version December 19, 2019, 3:31 pm UTC
 */

class MetaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'keywords',
        'page_id',
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
        return Meta::class;
    }

    public function search($request)
    {
        $queryTranslation = MetaTranslation::query();
        if (request()->filled('title')) $queryTranslation->where('title', 'LIKE', "%{request('title')}%"); //name
        if (request()->filled('description')) $queryTranslation->where('description', 'LIKE', "%{request('description')}%"); //email
        if (request()->filled('keywords')) $queryTranslation->where('keywords', 'LIKE', "%{request('keywords')}%"); //email
        return $queryTranslation->pluck('meta_id')->toArray();
        $query = Meta::query();

        // $query->where('id', $queryTranslation->pluck('meta_id')->toArray());
        if (request()->filled('status')) $query->where('status', $request->status); //status

        $metas = $query->paginate(10);

        return $metas;
    }
}
