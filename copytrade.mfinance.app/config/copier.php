<?php

use App\Models\CopierRiskType;
use App\Models\CopierType;

return [

    /*
    |--------------------------------------------------------------------------
    | JFX Copier mode
    |--------------------------------------------------------------------------
    |
    | This option controls the default value for copier mode
    |
    | Supported: "0 - sync disabled", "1 - debug enabled", "2 - calc stat", "4 - mysql skip own",
    |            "8 - mysql watcher", "16 - close when", "32 - load EA"
    |
    */
    'jfx_mode' => env('JFX_MODE', 0),
    'jfx_debug' => env('JFX_DEBUG', 0),
    'db_host' => env('COPIER_DB_HOST', '127.0.0.1'),
    'monitor_last_orders' => env('MONITOR_LAST_ORDERS', "20"),
    'aval_risk_types' => env('AVAL_RISK_TYPES', implode(',',[
        CopierRiskType::MULTIPLIER,
        CopierRiskType::FIXED_LOT,
        CopierRiskType::MONEY_RATIO,
        CopierRiskType::RISK_PERCENT,
        CopierRiskType::SCALING
    ])),

    'max_accounts_def' => env('MAX_ACCOUNTS', 1),
    'restart_invalid_every_minutes' => env('RESTART_INVALID_EVERY_MINUTES', null),


    /*
    |--------------------------------------------------------------------------
    | Memory cache mode
    |--------------------------------------------------------------------------
    |
    | This option controls what to save to memory cache. Redis is used.
    |
    | Supported: "0 - disabled", "1 - account info", "2 - live orders", "4 - current day orders"
    |
    */
    'memc_mode' => env('MEMC_MODE', 1),
    'delay_ms' => env('COPIER_DELAY_MS', 1000),

    'api_service_port' => env('API_SERVICE_PORT', 50000),
    'api_single_thread' => env('API_SINGLE_THREAD', false),
    'has_adv_filters' =>  env('HAS_ADV_FILTER', false),

];
