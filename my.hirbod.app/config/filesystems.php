<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'liara'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => public_path('uploads'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path(),
            'url' => env('APP_URL').'/tmp',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
        ],

        'ftp' => [
            'driver' => 'ftp',
            'host' => env('FTP_HOST', 'https://s.hirbod.ac'),
            'username' => env('FTP_USERNAME'),
            'password' => env('FTP_PASSWORD'),
            'port' => env('FTP_PORT', 21),
            'root' => '/',
            'passive' => true,
            'ssl' => true,
            'timeout' => 3600,
        ],

        'sara' => [
            'driver' => 's3',
            'key' => env('SARA_ACCESS_KEY_ID'),
            'secret' => env('SARA_SECRET_ACCESS_KEY'),
            'region' => env('SARA_DEFAULT_REGION', ''),
            'bucket' => env('SARA_BUCKET'),
            'endpoint' => env('SARA_ENDPOINT'),
        ],

        'liara' => [
            'driver' => 's3',
            'region' => 'us-east-1',
            'use_path_style_endpoint' => true,
            'key' => env('LIARA_ACCESS_KEY'),
            'secret' => env('LIARA_SECRET_KEY'),
            'bucket' => env('LIARA_BUCKET'),
            'endpoint' => env('LIARA_ENDPOINT'),
        ],


        'arvan' => [
            'driver' => 's3',
            'region' => '',
            'use_path_style_endpoint' => true,
            'key' => env('ARVAN_ACCESS_KEY_ID'),
            'secret' => env('ARVAN_SECRET_ACCESS_KEY'),
            'bucket' => env('ARVAN_BUCKET'),
            'endpoint' => env('ARVAN_URL')
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
