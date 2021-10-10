<?php

namespace App\Models;

use Eloquent as Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Meta extends Model implements TranslatableContract
{
    use Translatable;

    public $table = 'metas';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  ['title', 'description', 'keywords'];



    public $fillable = [
        'status',
        'page'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'            => 'integer',
        'page_id'       => 'integer',
        'title'         => 'string',
        'description'   => 'string',
        'keywords'      => 'string',
        'status'        => 'integer'
    ];



    /**
     * Scope a query to order data.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type    ['asc', 'desc']
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSorted($query, $type = 'asc')
    {
        return $query->orderBy('metas.id', $type);
    }

    /**
     * Gets page specified for meta
     *
     * @return Collection
     */
    public function page()
    {
        return $this->belongsTo('App\Models\Page', 'page_id', 'id');
    }
}
