<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Horizon Domain
    |--------------------------------------------------------------------------
    |
    | This is the subdomain where Horizon will be accessible from. If this
    | setting is null, Horizon will reside under the same domain as the
    | application. Otherwise, this value will serve as the subdomain.
    |
    */

    'domain' => null,

    /*
    |--------------------------------------------------------------------------
    | Horizon Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where Horizon will be accessible from. Feel free
    | to change this path to anything you like. Note that the URI will not
    | affect the paths of its internal API that aren't exposed to users.
    |
    */

    'path' => 'horizon',

    /*
    |--------------------------------------------------------------------------
    | Horizon Redis Connection
    |--------------------------------------------------------------------------
    |
    | This is the name of the Redis connection where Horizon will store the
    | meta information required for it to function. It includes the list
    | of supervisors, failed jobs, job metrics, and other information.
    |
    */

    'use' => 'default',

    /*
    |--------------------------------------------------------------------------
    | Horizon Redis Prefix
    |--------------------------------------------------------------------------
    |
    | This prefix will be used when storing all Horizon data in Redis. You
    | may modify the prefix when you are running multiple installations
    | of Horizon on the same server so that they don't have problems.
    |
    */

    'prefix' => env(
        'APP_ENV'.':', '_horizon:'
    ),


    /*
    |--------------------------------------------------------------------------
    | Horizon Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will get attached onto each Horizon route, giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'middleware' => ['web','admin'],

    /*
    |--------------------------------------------------------------------------
    | Queue Wait Time Thresholds
    |--------------------------------------------------------------------------
    |
    | This option allows you to configure when the LongWaitDetected event
    | will be fired. Every connection / queue combination may have its
    | own, unique threshold (in seconds) before this event is fired.
    |
    */

    'waits' => [
        'redis:default' => 60,
    ],

    /*
    |--------------------------------------------------------------------------
    | Job Trimming Times
    |--------------------------------------------------------------------------
    |
    | Here you can configure for how long (in minutes) you desire Horizon to
    | persist the recent and failed jobs. Typically, recent jobs are kept
    | for one hour while all failed jobs are stored for an entire week.
    |
    */

    'trim' => [
        'recent' => 60,
        'recent_failed' => 10080,
        'failed' => 10080,
        'monitored' => 10080,
    ],

    /*
    |--------------------------------------------------------------------------
    | Fast Termination
    |--------------------------------------------------------------------------
    |
    | When this option is enabled, Horizon's "terminate" command will not
    | wait on all of the workers to terminate unless the --wait option
    | is provided. Fast termination can shorten deployment delay by
    | allowing a new instance of Horizon to start while the last
    | instance will continue to terminate each of its workers.
    |
    */

    'fast_termination' => false,

    /*
    |--------------------------------------------------------------------------
    | Memory Limit (MB)
    |--------------------------------------------------------------------------
    |
    | This value describes the maximum amount of memory the Horizon worker
    | may consume before it is terminated and restarted. You should set
    | this value according to the resources available to your server.
    |
    */

    'memory_limit' => 64,

    /*
    |--------------------------------------------------------------------------
    | Queue Worker Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may define the queue worker settings used by your application
    | in all environments. These supervisors and settings handle all your
    | queued jobs and will be provisioned by Horizon during deployment.
    |
    */

    'environments' => [
        'local' => [
            'default' => [
                'connection' => 'redis',
                'queue' => ['default','social','removing'],
                'balance' => 'simple',
                'processes' => 1,
                'tries' => 5,
            ],
        ],
        'd4t-accounts' => [
            'default' => [
                'connection' => 'redis',
                'queue' => ['default','social','removing'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ],
            '78.159.99.194' => [
                'connection' => 'redis',
                'queue' => ['78.159.99.194'],
                'balance' => 'auto',
                'processes' => 1,
                'tries' => 10,
            ],
        ],
        'tudor' => [
            'default' => [
                'connection' => 'redis',
                'queue' => ['default','social','removing'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ],
            '195.12.190.188' => [
                'connection' => 'redis',
                'queue' => ['195.12.190.188'],
                'balance' => 'auto',
                'processes' => 1,
                'tries' => 10,
            ],
            '195.12.190.85' => [
                'connection' => 'redis',
                'queue' => ['195.12.190.85'],
                'balance' => 'auto',
                'processes' => 1,
                'tries' => 10,
            ],
            '95.217.79.46' => [
                'connection' => 'redis',
                'queue' => ['95.217.79.46'],
                'balance' => 'auto',
                'processes' => 1,
                'tries' => 10,
            ],
            '95.217.40.149' => [
                'connection' => 'redis',
                'queue' => ['95.217.40.149'],
                'balance' => 'auto',
                'processes' => 1,
                'tries' => 10,
            ],
            '135.181.131.126' => [
                'connection' => 'redis',
                'queue' => ['135.181.131.126'],
                'balance' => 'auto',
                'processes' => 1,
                'tries' => 10,
            ],
            '135.181.76.148' => [
                'connection' => 'redis',
                'queue' => ['135.181.76.148'],
                'balance' => 'auto',
                'processes' => 1,
                'tries' => 10,
            ],
            '51.195.88.137' => [
                'connection' => 'redis',
                'queue' => ['51.195.88.137'],
                'balance' => 'auto',
                'processes' => 1,
                'tries' => 10,
            ],
            '135.181.76.165' => [
                'connection' => 'redis',
                'queue' => ['135.181.76.165'],
                'balance' => 'auto',
                'processes' => 1,
                'tries' => 10,
            ],
            '135.181.133.62' => [
                'connection' => 'redis',
                'queue' => ['135.181.133.62'],
                'balance' => 'auto',
                'processes' => 1,
                'tries' => 10,
            ],
            '88.119.176.53' => [
                'connection' => 'redis',
                'queue' => ['88.119.176.53'],
                'balance' => 'auto',
                'processes' => 1,
                'tries' => 10,
            ],
            '88.119.176.54' => [
                'connection' => 'redis',
                'queue' => ['88.119.176.54'],
                'balance' => 'auto',
                'processes' => 1,
                'tries' => 10,
            ],
            '88.119.176.57' => [
                'connection' => 'redis',
                'queue' => ['88.119.176.57'],
                'balance' => 'auto',
                'processes' => 1,
                'tries' => 10,
            ],
            '195.12.190.27' => [
                'connection' => 'redis',
                'queue' => ['195.12.190.27'],
                'balance' => 'auto',
                'processes' => 1,
                'tries' => 10,
            ],
            '195.12.190.218' => [
                'connection' => 'redis',
                'queue' => ['195.12.190.218'],
                'balance' => 'auto',
                'processes' => 1,
                'tries' => 10,
            ],
            '217.182.196.236' => [
                'connection' => 'redis',
                'queue' => ['217.182.196.236'],
                'balance' => 'auto',
                'processes' => 1,
                'tries' => 10,
            ],
        ],
        'accounts' => [
            'default' => [
                'connection' => 'redis',
                'queue' => ['default','social','removing'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ],
            '138.201.23.32' => [
                'connection' => 'redis',
                'queue' => ['138.201.23.32'],
                'balance' => 'auto',
                'processes' => 1,
                'tries' => 10,
            ],
            '116.202.226.205' => [
                'connection' => 'redis',
                'queue' => ['116.202.226.205'],
                'balance' => 'auto',
                'processes' => 1,
                'tries' => 10,
            ],
        ],
        'defender' => [
            'default' => [
                'connection' => 'redis',
                'queue' => ['default','social','removing'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ]
        ],
        'reginald' => [
            'default' => [
                'connection' => 'redis',
                'queue' => ['default','social','removing'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ],
            'accounts' => [
                'connection' => 'redis',
                'queue' => ['accounts'],
                'balance' => 'simple',
                'processes' => 1,
                'tries' => 5,
            ],
            '74.208.40.56' => [
                'connection' => 'redis',
                'queue' => ['74.208.40.56'],
                'balance' => 'auto',
                'processes' => 2,
                'tries' => 10,
            ],
            '74.208.24.29' => [
                'connection' => 'redis',
                'queue' => ['74.208.24.29'],
                'balance' => 'auto',
                'processes' => 2,
                'tries' => 10,
            ],
        ],
        'idiot' => [
            'default' => [
                'connection' => 'redis',
                'queue' => ['default','social','removing'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ],
            'accounts' => [
                'connection' => 'redis',
                'queue' => ['accounts'],
                'balance' => 'simple',
                'processes' => 1,
                'tries' => 5,
            ],
        ],
        'blake' => [
            'default' => [
                'connection' => 'redis',
                'queue' => ['default','social','removing'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ],
            '163.172.86.205' => [
                'connection' => 'redis',
                'queue' => ['163.172.86.205'],
                'balance' => 'simple',
                'processes' => 1,
                'tries' => 5,
            ],
            '142.54.177.10' => [
                'connection' => 'redis',
                'queue' => ['142.54.177.10'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ],
            '173.208.190.250' => [
                'connection' => 'redis',
                'queue' => ['173.208.190.250'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ],
        ],
        'profitmama' => [
            'default' => [
                'connection' => 'redis',
                'queue' => ['default','social','removing'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ],
            '173.198.235.98' => [
                'connection' => 'redis',
                'queue' => ['173.198.235.98'],
                'balance' => 'simple',
                'processes' => 1,
                'tries' => 5,
            ],
            'accounts' => [
                'connection' => 'redis',
                'queue' => ['accounts'],
                'balance' => 'simple',
                'processes' => 1,
                'tries' => 5,
            ]
        ],
        'copier' => [
            'default' => [
                'connection' => 'redis',
                'queue' => ['default','social','removing'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ],
            'accounts' => [
                'connection' => 'redis',
                'queue' => ['accounts'],
                'balance' => 'simple',
                'processes' => 1,
                'tries' => 5,
            ]
        ],
        'fabian' => [
            'default' => [
                'connection' => 'redis',
                'queue' => ['default','social','removing'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ],
            'accounts' => [
                'connection' => 'redis',
                'queue' => ['accounts'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ],
            '163.182.173.66' => [
                'connection' => 'redis',
                'queue' => ['163.182.173.66'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ],
            '163.182.171.118' => [
                'connection' => 'redis',
                'queue' => ['163.182.171.118'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ],
            '173.233.68.86' => [
                'connection' => 'redis',
                'queue' => ['173.233.68.86'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ]
        ],
        'david' => [
            'default' => [
                'connection' => 'redis',
                'queue' => ['default','social','removing'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ],
            'accounts' => [
                'connection' => 'redis',
                'queue' => ['accounts'],
                'balance' => 'simple',
                'processes' => 1,
                'tries' => 5,
            ],
            '199.223.252.202' => [
                'connection' => 'redis',
                'queue' => ['199.223.252.202'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ],
            '104.129.168.178' => [
                'connection' => 'redis',
                'queue' => ['104.129.168.178'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ],
            '23.226.135.42' => [
                'connection' => 'redis',
                'queue' => ['23.226.135.42'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ],
            '23.106.59.149' => [
                'connection' => 'redis',
                'queue' => ['23.106.59.149'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ],
            '23.106.36.167' => [
                'connection' => 'redis',
                'queue' => ['23.106.36.167'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ]
        ],
        'fxe' => [
            'default' => [
                'connection' => 'redis',
                'queue' => ['default','social','removing'],
                'balance' => 'simple',
                'processes' => 3,
                'tries' => 5,
            ],
            '67.231.241.10' => [
                'connection' => 'redis',
                'queue' => ['67.231.241.10'],
                'balance' => 'simple',
                'processes' => 1,
                'tries' => 5,
            ],
            '199.223.252.58' => [
                'connection' => 'redis',
                'queue' => ['199.223.252.58'],
                'balance' => 'auto',
                'processes' => 2,
                'tries' => 10,
            ],
            '84.16.231.173' => [
                'connection' => 'redis',
                'queue' => ['84.16.231.173'],
                'balance' => 'auto',
                'processes' => 2,
                'tries' => 10,
            ],
            '178.162.218.27' => [
                'connection' => 'redis',
                'queue' => ['178.162.218.27'],
                'balance' => 'auto',
                'processes' => 2,
                'tries' => 10,
            ],
            '199.223.252.150' => [
                'connection' => 'redis',
                'queue' => ['199.223.252.150'],
                'balance' => 'auto',
                'processes' => 2,
                'tries' => 10,
            ],
        ],
    ],
];
