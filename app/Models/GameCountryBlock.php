<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $brandid
 * @property string $launchcode
 * @property string $country
 * @property string $blocked_date
 * @property boolean $logged_out
 * @property boolean $unfunded
 * @property Country[] $countries
 */
class GameCountryBlock extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'game_country_block';

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['brandid', 'launchcode', 'country', 'blocked_date', 'logged_out', 'unfunded'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function countries(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Country', 'code', 'country');
    }
}
