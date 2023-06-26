<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $brandid
 * @property string $name
 * @property string $category
 * @property string $image
 * @property string $description
 * @property integer $user_id
 * @property string $last_modified
 * @property boolean $active
 * @property integer $seq
 * @property Brand $brand
 */
class Category extends Model
{
    public function scopeNotMobile(Builder $query): void
    {
        $query->where('category', 'NOT LIKE',  "mobile%")
            ->where('category', 'NOT LIKE',  "%mobile");
    }
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'category';

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['brandid', 'name', 'category', 'image', 'description', 'user_id', 'last_modified', 'active', 'seq'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Brand', 'brandid');
    }
}
