<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $brandid
 * @property string $launchcode
 * @property string $blocked_date
 * @property Brand $brand
 */
class GameBrandBlock extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'game_brand_block';

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['brandid', 'launchcode', 'blocked_date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Brand', 'brandid');
    }
}
