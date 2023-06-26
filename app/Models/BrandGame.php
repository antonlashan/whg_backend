<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $brandid
 * @property string $launchcode
 * @property string $category
 * @property integer $seq
 * @property boolean $hot
 * @property boolean $new
 * @property string $sub_category
 * @property Brand $brand
 * @property Game $game
 * @property Category $categoryR
 */
class BrandGame extends Model
{
    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['brandid', 'launchcode', 'category', 'seq', 'hot', 'new', 'sub_category'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'hot' => 'boolean',
        'new' => 'boolean',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Brand', 'brandid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Game', 'launchcode', 'launchcode');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoryR(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Category', 'category', 'category');
    }
}
