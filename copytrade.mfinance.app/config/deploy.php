<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default deployment strategy
    |--------------------------------------------------------------------------
    |
    | This option defines which deployment strategy to use by default on all
    | of your hosts. Laravel Deployer provides some strategies out-of-box
    | for you to choose from explained in detail in the documentation.
    |
    | Supported: 'basic', 'firstdeploy', 'local', 'pull'.
    |
    */

    'default' => 'basic',

    /*
    |--------------------------------------------------------------------------
    | Custom deployment strategies
    |--------------------------------------------------------------------------
    |
    | Here, you can easily set up new custom strategies as a list of tasks.
    | Any key of this array are supported in the `default` option above.
    | Any key matching Laravel Deployer's strategies overrides them.
    |
    */

    'strategies' => [
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Hooks
    |--------------------------------------------------------------------------
    |
    | Hooks let you customize your deployments conveniently by pushing tasks
    | into strategic places of your deployment flow. Each of the official
    | strategies invoke hooks in different ways to implement their logic.
    |
    */

    'hooks' => [
        // Right before we start deploying.
        'start' => [
            //
        ],

        // Code and composer vendors are ready but nothing is built.
        'build' => [
            //
        ],

        // Deployment is done but not live yet (before symlink)
        'ready' => [
            'artisan:storage:link',
            'artisan:view:clear',
            'artisan:cache:clear',
            'artisan:config:cache',
        ],

        // Deployment is done and live
        'done' => [
            'fpm:reload'
        ],

        'rollback' => [
            'fpm:reload'
        ],

        // Deployment succeeded.
        'success' => [
        ],

        // Deployment failed.
        'fail' => [
            //
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Deployment options
    |--------------------------------------------------------------------------
    |
    | Options follow a simple key/value structure and are used within tasks
    | to make them more configurable and reusable. You can use options to
    | configure existing tasks or to use within your own custom tasks.
    |
    */

    'options' => [
        'application' => env('APP_NAME', 'Laravel'),
        'repository' => 'git@github.com:mikha-dev/new-trade-copier.git',
        'composer_options' => '{{composer_action}} --verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader --no-suggest',
        'composer_action' => 'install',
        'php_fpm_service' => 'php7.3-fpm',
    ],

    /*
    |--------------------------------------------------------------------------
    | Hosts
    |--------------------------------------------------------------------------
    |
    | Here, you can define any domain or subdomain you want to deploy to.
    | You can provide them with roles and stages to filter them during
    | deployment. Read more about how to configure them in the docs.
    |
    */

    'hosts' => [
        'copier.faceforex.com' => [
            'deploy_path' => '/var/www/html/copier',
            'user' => 'ubuntu',
            'stage' => 'aman',
        ],
        'david.dev4traders.com' => [
            'deploy_path' => '/var/www/html/copier',
            'user' => 'root',
            'stage' => 'david',
        ],
        '167.99.150.159' => [
            'deploy_path' => '/var/www/html/defender',
            'user' => 'root',
            'stage' => 'cedric',
        ],
        '69.164.210.64' => [
            'deploy_path' => '/var/www/html/copier',
            'user' => 'root',
            'stage' => 'profitmama',
        ],
        '178.79.181.129' => [
            'deploy_path' => '/var/www/html/tudor',
            'user' => 'root',
            'stage' => 'tudor',
        ],
        'accounts.dev4traders.com' => [
            'deploy_path' => '/var/www/html/d4t-accounts',
            'user' => 'root',
            'stage' => 'd4t-accounts',
        ],
        'defender.dev4traders.com' => [
            'deploy_path' => '/var/www/html/defender',
            'user' => 'root',
            'stage' => 'defender',
        ],
        'panel.bestradingexpertadvisor.tech' => [
            'deploy_path' => '/var/www/html/tech',
            'user' => 'root',
            'stage' => 'tech',
        ],
        'demo.dev4traders.com' => [
            'deploy_path' => '/var/www/html/demo',
            'user' => 'root',
            'stage' => 'demo',
        ],
        'copier.dev4traders.com' => [
            'deploy_path' => '/var/www/html/copier',
            'user' => 'root',
            'stage' => 'copier',
        ],
        'panel.fafxservice.com' => [
            'deploy_path' => '/var/www/html/fabio',
            'user' => 'root',
            'stage' => 'fabio',
        ],
        '45.77.189.232' => [
            'deploy_path' => '/var/www/html/copier',
            'user' => 'root',
            'stage' => 'fabian',
        ],
        '139.162.203.29' => [
            'deploy_path' => '/var/www/html/copier',
            'user' => 'root',
            'stage' => 'reginald',
        ],
        '172.105.72.197' => [
            'deploy_path' => '/var/www/html/copier',
            'user' => 'root',
            'stage' => 'idiot',
        ],
        'panel.algosamurai.com' => [
            'deploy_path' => '/var/www/html/copier',
            'user' => 'root',
            'port' => 2224,
            'stage' => 'blake',
        ],
        'panel.smartfxtrader.com' => [
            'deploy_path' => '/var/www/html/new-trade-copier',
            'user' => 'root',
            'stage' => 'smartfx'
        ],
        '172.105.90.117' => [
            'deploy_path' => '/var/www/html/new-trade-copier',
            'user' => 'root',
            'stage' => 'fxe'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Localhost
    |--------------------------------------------------------------------------
    |
    | This localhost option give you the ability to deploy directly on your
    | local machine, without needing any SSH connection. You can use the
    | same configurations used by hosts to configure your localhost.
    |
    */

    'localhost' => [
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Include additional Deployer recipes
    |--------------------------------------------------------------------------
    |
    | Here, you can add any third party recipes to provide additional tasks,
    | options and strategies. Therefore, it also allows you to create and
    | include your own recipes to define more complex deployment flows.
    |
    */

    'include' => [
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Use a custom Deployer file
    |--------------------------------------------------------------------------
    |
    | If you know what you are doing and want to take complete control over
    | Deployer's file, you can provide its path here. Note that, without
    | this configuration file, the root's deployer file will be used.
    |
    */

    'custom_deployer_file' => false,

];