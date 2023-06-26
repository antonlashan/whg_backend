<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $code
 * @property integer $id
 * @property string $jurisdiction_id
 * @property string $country
 * @property GameCountryBlock $gameCountryBlock
 */
class Country extends Model
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
    protected $fillable = ['jurisdiction_id', 'country'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gameCountryBlock(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\GameCountryBlock', 'code', 'country');
    }
}
