<?php namespace KitSoft\Plenary\Classes;

use Cache;

use Kitsoft\Plenary\Models\Plenary as PlenaryModel;
use Carbon\Carbon;
use Predis\Client;

class PlenaryHelpers
{

    CONST CACHE_KEY = 'PLENARY';

    /**
     * @return string
     */
    public static function getCacheKey()
    {
        return self::CACHE_KEY;
    }

    public static function getPlenaryContent($slug)
    {
        $cacheKey = self::getCacheKey();

        if (!$data = Cache::get($cacheKey)) {
            $data = PlenaryModel::where('slug', $slug)->first();
            Cache::forever($cacheKey, $data->toArray());
        }
    }
}
