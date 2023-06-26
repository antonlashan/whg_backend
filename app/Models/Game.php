<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $launchcode
 * @property integer $game_provider_id
 * @property string $name
 * @property string $publisher
 * @property integer $width
 * @property integer $height
 * @property string $disclaimer
 * @property boolean $active
 * @property string $image
 * @property integer $user_id
 * @property string $last_modified
 * @property boolean $desktop
 * @property boolean $mobile
 * @property integer $game_type_id
 * @property float $min
 * @property float $max
 * @property float $gamelimit
 * @property boolean $fun_supported
 * @property boolean $iframe
 * @property string $provider
 * @property string $date_added
 * @property float $rtp
 * @property boolean $jackpot
 * @property string $seo_name
 * @property string $help
 * @property boolean $row_custom_image
 * @property integer $reels
 * @property integer $rows
 * @property integer $lines
 * @property string $volatility
 * @property boolean $is_state
 * @property BrandGame[] $brandGames
 * @property GameProvider $gameProvider
 */
class Game extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'game';

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['game_provider_id', 'name', 'publisher', 'width', 'height', 'disclaimer', 'active', 'image', 'user_id', 'last_modified', 'desktop', 'mobile', 'game_type_id', 'min', 'max', 'gamelimit', 'fun_supported', 'iframe', 'provider', 'date_added', 'rtp', 'jackpot', 'seo_name', 'help', 'row_custom_image', 'reels', 'rows', 'lines', 'volatility', 'is_state'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'rtp' => 'float',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function brandGames(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\BrandGame', 'launchcode', 'launchcode');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gameProvider(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\GameProvider');
    }
}
