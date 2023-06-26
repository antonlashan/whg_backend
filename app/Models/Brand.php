<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $licensee_id
 * @property string $brand
 * @property string $stage_url
 * @property string $site_url
 * @property string $path
 * @property string $live_server
 * @property integer $live_ssh_port
 * @property boolean $enabled
 * @property string $group_name
 * @property boolean $live_update_enabled
 * @property string $params
 * @property BrandGame[] $brandGames
 * @property Category[] $categories
 * @property GameBrandBlock[] $gameBrandBlocks
 */
class Brand extends Model
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
    protected $fillable = ['licensee_id', 'brand', 'stage_url', 'site_url', 'path', 'live_server', 'live_ssh_port', 'enabled', 'group_name', 'live_update_enabled', 'params'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'params',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function brandGames(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\BrandGame', 'brandid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Category', 'brandid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gameBrandBlocks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\GameBrandBlock', 'brandid');
    }
}
