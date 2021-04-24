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

    'default' => env('FILESYSTEM_DRIVER', 'local'),

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

    'cloud' => env('FILESYSTEM_CLOUD', 'google'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'admin' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'files' => [
            'driver' => 'local',
            'root' => resource_path('files'),
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_KEY'),
            'secret' => env('AWS_SECRET'),
            'region' => env('AWS_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],

        'google' => [
            'driver' => 'google',
            'clientId' => env('GOOGLE_DRIVE_CLIENT_ID', '176522595065-5c5gfvul45fkn5cqu8o1oe7j615ibe19.apps.googleusercontent.com'),
            'clientSecret' => env('GOOGLE_DRIVE_CLIENT_SECRET', 'UzlI4xXzp7k1sFQCb-J-FxWX'),
            'refreshToken' => env('GOOGLE_DRIVE_REFRESH_TOKEN', '1//04t6-GCDsvL8NCgYIARAAGAQSNwF-L9Irp1C4TrUxvkGzx4snHg1Gq1wQNs0z-9VJv8CNf3APJEjsiaQbz-hijDMMMhInnOZ3zME'),
            'folderId' => env('GOOGLE_DRIVE_FOLDER_ID', '1-fvq75lRdjn8AlFP7-S-GZlFw2VJOApI'),
        ],

    ],

];
