<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandGame;
use App\Models\Category;
use App\Models\Country;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Brand::where('enabled', 1)
            ->get(['id', 'brand']);
    }

    public function categories(int $id)
    {
        Brand::findOrFail($id);

        return Category::where('active', 1)
            ->where('brandid', $id)
            ->notMobile()
            ->orderBy('seq')
            ->get(['brandid', 'category', 'name', 'seq']);
    }

    public function games(Request $request, int $id)
    {
        $country_code = $request->query('country_code');

        Brand::findOrFail($id);

        if ($country_code !== NULL) {
            Country::where('code', '=', $country_code)->firstOrFail();
        }

        $noOfGamesPerCategory = 5;

        $brandGames = BrandGame::select([
            'brand_games.hot as brand_games_hot',
            'brand_games.new as brand_games_new',
            'brand_games.seq as brand_games_seq',
            'brand_games.category as brand_games_category',
            'game.name as game_name',
            'game.launchcode as game_launchcode',
            'game.rtp as game_rtp',
            'game.provider as game_provider',
            DB::raw('ROW_NUMBER() OVER (PARTITION BY `brand_games`.`category` ORDER BY `brand_games`.`seq` ) AS `rank`'),
        ])
            ->where('brand_games.brandid', $id)
            ->join('game', function (JoinClause $join) {
                $join->on('game.launchcode', '=', 'brand_games.launchcode')
                    ->where('game.active', '=', 1);
            })
            ->whereExists(function ($query) use ($id) {
                $query->select(DB::raw(1))
                    ->from('category')
                    ->whereColumn('category.category', 'brand_games.category')
                    ->whereColumn('category.brandid', 'brand_games.brandid')
                    // @TODO Im not sure but otherwise duplicateting category names
                    // check category model scope too
                    ->where('category.category', 'NOT LIKE',  "mobile%")
                    ->where('category', 'NOT LIKE',  "%mobile")
                    ->where('active', '=', 1);
            })
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('game_brand_block')
                    ->whereColumn('game_brand_block.launchcode', 'brand_games.launchcode')
                    ->whereColumn('game_brand_block.brandid', 'brand_games.brandid');
            });

        if ($country_code) {
            $brandGames->whereNotExists(function ($query) use ($country_code) {
                $query->select(DB::raw(1))
                    ->from('game_country_block')
                    ->whereColumn('game_country_block.launchcode', 'brand_games.launchcode')
                    ->where(function ($query) {
                        $query->whereColumn('game_country_block.brandid', 'brand_games.brandid')
                            ->orWhere('game_country_block.brandid', '=', 0);
                    })
                    ->where('game_country_block.country', '=', $country_code);
            });
        }

        return DB::table(DB::raw("({$brandGames->toSql()}) as sub"))
            ->mergeBindings($brandGames->getQuery())
            ->where('rank', '<=', $noOfGamesPerCategory)
            ->get()
            ->map(function ($item) {
                return [
                    'hot' => (bool) $item->brand_games_hot,
                    'new' => (bool)$item->brand_games_new,
                    'seq' => $item->brand_games_seq,
                    'category' => $item->brand_games_category,
                    'game' => [
                        'name' => $item->game_name,
                        'launchcode' => $item->game_launchcode,
                        'rtp' => (float) $item->game_rtp,
                        'provider' => $item->game_provider,
                    ]
                ];
            });
    }
}
