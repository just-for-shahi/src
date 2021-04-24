<?php


namespace App\Scripts\Helpers;


use Carbon\Carbon;

/**
 * Class GlobalHelper
 * @package App\Scripts\Helpers
 */
class GoHelper
{
    private static $prefix = 'ocis.main';
    public const NO_CHILDREN_DRS = 't5erf#';
    public const SET_REFERRING_DR = 'gtr624sa$';
    public const RETRY_MONITORING_TOKEN = '64TeHdb';
    public const SETTINGS = '7W3CuXfh';
    public const DISABLE_AUTO_UPLOADED_FILE_STORE = '7W3CuXfYx';

    /**
     * Set the given value or retrieve the global data according to key.
     * @param $key
     * @param $value
     * @return mixed|null
     */
    public static function set_or_get($key, $value)
    {
        $val = self::go($key);
        if ($val) {
            return $val;
        }

        self::go($key, $value);
        return null;
    }

    /**
     * @param $key
     * @param null $value
     * @return mixed|null
     */
    public static function go($key, $value = null)
    {
        if ($value) {
            $GLOBALS[$key] = $value;
        } else {
            return $GLOBALS[$key] ?? null;
        }

        return $value;
    }

    /**
     * @param $key
     * @param mixed|callable|null $value
     * @return mixed|null
     */
    public static function remember($key, $value = null)
    {
        $key = "x5-zxw-$key";
        if (is_callable($value)) {
            $value = $value();
        }

        return self::go($key, $value);
    }

    public static function goCache($key, $value = null, $pull = false, Carbon $ttl = null)
    {
        if (!$ttl) {
            $ttl = now()->addYear();
        }

        $key = self::$prefix . "_$key";
        if ($value) {
            cache()->put($key, $value, $ttl);
        } else if (cache()->has($key)) {
            return $pull ? cache()->pull($key) : cache()->get($key);
        }

        return $value;
    }
}
