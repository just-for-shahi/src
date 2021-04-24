<?php

return [

    'user_start_page' =>env('USER_START_PAGE', ''),
    'send_account_invalid_email' => env('SEND_ACCOUNT_INVALID_EMAIL', false),

    'kustomer_enabled' => env('KUSTOMER_ENABLED', false),


    'has_setting' => env('HAS_SETTING', false),
    'login_has_lost_password' => env('ALLOW_LOST_PASSWORD', true),
    'login_has_register' => env('ALLOW_REGISTER', false),
    'ws_host' => env('WS_HOST', '127.0.0.1'),

    'activation' => env('ACTIVATION', false),
    'maxAttempts' => env('ACTIVATION_LIMIT_MAX_ATTEMPTS', 3),
    'timePeriod' => env('ACTIVATION_LIMIT_TIME_PERIOD', 24),

    'registration_role' => env('REGISTRATION_ROLE', 'user'),
    'registration_creator_id' => env('REGISTRATION_CREATOR_ID', 1),

    'reCaptchStatus' => env('ENABLE_RECAPTCHA', false),
    /*
     * ReCaptcha Site Key
     */
    'reCaptchSite'   => env('RE_CAP_SITE', 'YOURGOOGLECAPTCHAsitekeyHERE'),

    /*
     * ReCaptcha Secret
     */
    'reCaptchSecret' => env('RE_CAP_SECRET', 'YOURGOOGLECAPTCHAsecretHERE'),

    'nullIpAddress' => env('NULL_IP_ADDRESS', '0.0.0.0'),

    'powered_by' => env('POWERED_BY'),

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin name
    |--------------------------------------------------------------------------
    |
    | This value is the name of laravel-admin, This setting is displayed on the
    | login page.
    |
    */
    'name'      => env('APP_NAME'),

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin logo
    |--------------------------------------------------------------------------
    |
    | The logo of all admin pages. You can also set it as an image by using a
    | `img` tag, eg '<img src="http://logo-url" alt="Admin logo">'.
    |
    */
    'login_logo'   => env('LOGIN_LOGO', env('APP_NAME')),

    'logo'      => env('APP_LOGO', env('APP_NAME')),

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin mini logo
    |--------------------------------------------------------------------------
    |
    | The logo of all admin pages when the sidebar menu is collapsed. You can
    | also set it as an image by using a `img` tag, eg
    | '<img src="http://logo-url" alt="Admin logo">'.
    |
    */
    'logo-mini' => env('APP_NAME_SHORT'),

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin bootstrap setting
    |--------------------------------------------------------------------------
    |
    | This value is the path of laravel-admin bootstrap file.
    |
    */
    'bootstrap' => app_path('Admin/bootstrap.php'),

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin route settings
    |--------------------------------------------------------------------------
    |
    | The routing configuration of the admin page, including the path prefix,
    | the controller namespace, and the default middleware. If you want to
    | access through the root path, just set the prefix to empty string.
    |
    */
    'route' => [

        'prefix' => env('ADMIN_PREFIX','admin'),

        'namespace'     => 'App\\Admin\\Controllers',

        'middleware'    => ['web', 'admin'],
    ],
    /*
    |--------------------------------------------------------------------------
    | Laravel-admin install directory
    |--------------------------------------------------------------------------
    |
    | The installation directory of the controller and routing configuration
    | files of the administration page. The default is `app/Admin`, which must
    | be set before running `artisan admin::install` to take effect.
    |
    */
    'directory' => app_path('Admin'),

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin html title
    |--------------------------------------------------------------------------
    |
    | Html title for all pages.
    |
    */
    'title'  => env('APP_NAME'),

    /*
    |--------------------------------------------------------------------------
    | Access via `https`
    |--------------------------------------------------------------------------
    |
    | If your page is going to be accessed via https, set it to `true`.
    |
    */
    'https' => env('ADMIN_HTTPS', true),

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin auth setting
    |--------------------------------------------------------------------------
    |
    | Authentication settings for all admin pages. Include an authentication
    | guard and a user provider setting of authentication driver.
    |
    */
    'auth' => [
        'guards' => [
            'admin' => [
                'driver' => 'session',
                'provider' => 'admin',
            ]
        ],

        'providers' => [
            'admin' => [
                'driver' => 'eloquent',
                'model'  => App\User::class,
            ]
        ],

        // Add "remember me" to login form
        'remember' => true,

        // Redirect to the specified URI when user is not authorized.
        'redirect_to' => 'auth/login',

        // The URIs that should be excluded from authorization.
        'excepts' => [
            'auth/login',
            'auth/logout',
            'locale',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin upload setting
    |--------------------------------------------------------------------------
    |
    | File system configuration for form upload files and images, including
    | disk and upload path.
    |
    */
    'upload'  => [

        'disk' => 'public',

        'directory'  => [
            'image'  => 'images',
            'file'   => 'files',
        ]
    ],


    /*
    |--------------------------------------------------------------------------
    | Laravel-admin database settings
    |--------------------------------------------------------------------------
    |
    | Here are database settings for laravel-admin builtin model & tables.
    |
    */
    'database' => [

        // Database connection for following tables.
        'connection'  => '',

        // User tables and model.
        'users_table' => 'admin_users',
        'users_model' => App\User::class,

        // Role table and model.
        'roles_table' => 'admin_roles',
        'roles_model' => Encore\Admin\Auth\Database\Role::class,

        // Permission table and model.
        'permissions_table' => 'admin_permissions',
        'permissions_model' => Encore\Admin\Auth\Database\Permission::class,

        // Menu table and model.
        'menu_table'  => 'admin_menu',
        'menu_model'  => Encore\Admin\Auth\Database\Menu::class,

        // Pivot table for table above.
        'operation_log_table'    => 'admin_operation_log',
        'user_permissions_table' => 'admin_user_permissions',
        'role_users_table'       => 'admin_role_users',
        'role_permissions_table' => 'admin_role_permissions',
        'role_menu_table'        => 'admin_role_menu',
    ],

    /*
    |--------------------------------------------------------------------------
    | User operation log setting
    |--------------------------------------------------------------------------
    |
    | By setting this option to open or close operation log in laravel-admin.
    |
    */
    'operation_log'   => [

        'enable' => true,

        /*
         * Only logging allowed methods in the list
         */
        'allowed_methods' => ['GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'CONNECT', 'OPTIONS', 'TRACE', 'PATCH'],

        /*
         * Routes that will not log to database.
         *
         * All method to path like: admin/auth/logs
         * or specific method to path like: get:admin/auth/logs.
         */
        'except' => [
            'auth/logs*',
            'horizon*'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User default avatar
    |--------------------------------------------------------------------------
    |
    | Set a default avatar for newly created users.
    |
    */
    'default_avatar' => env('DEFAULT_AVATAR','/img/user2-160x160.png'),

    /*
    |--------------------------------------------------------------------------
    | Admin map field provider
    |--------------------------------------------------------------------------
    |
    | Supported: "tencent", "google", "yandex".
    |
    */
    'map_provider' => 'google',

    /*
    |--------------------------------------------------------------------------
    | Application Skin
    |--------------------------------------------------------------------------
    |
    | This value is the skin of admin pages.
    | @see https://adminlte.io/docs/2.4/skin
    |
    | Supported:
    |    "skin-blue", "skin-blue-light", "skin-yellow", "skin-yellow-light",
    |    "skin-green", "skin-green-light", "skin-purple", "skin-purple-light",
    |    "skin-red", "skin-red-light", "skin-black", "skin-black-light".
    |
    */
    'skin' => env('ADMIN_SKIN', 'skin-blue-light' ),

    /*
    |--------------------------------------------------------------------------
    | Application layout
    |--------------------------------------------------------------------------
    |
    | This value is the layout of admin pages.
    | @see https://adminlte.io/docs/2.4/layout
    |
    | Supported: "fixed", "layout-boxed", "layout-top-nav", "sidebar-collapse",
    | "sidebar-mini".
    |
    */
    'layout'  => ['sidebar-mini'],

    /*
    |--------------------------------------------------------------------------
    | Login page background image
    |--------------------------------------------------------------------------
    |
    | This value is used to set the background image of login page.
    |
    */
    'login_background_image' => env('LOGIN_BG_IMG', '/img/login-bg.jpg'),

    /*
    |--------------------------------------------------------------------------
    | Show version at footer
    |--------------------------------------------------------------------------
    |
    | Whether to display the version number of laravel-admim at the footer of
    | each page
    |
    */
    'show_version' => true,

    /*
    |--------------------------------------------------------------------------
    | Show environment at footer
    |--------------------------------------------------------------------------
    |
    | Whether to display the environment at the footer of each page
    |
    */
    'show_environment' => false,

    /*
    |--------------------------------------------------------------------------
    | Menu bind to permission
    |--------------------------------------------------------------------------
    |
    | whether enable menu bind to a permission
    */
    'menu_bind_permission' => true,

    /*
    |--------------------------------------------------------------------------
    | Enable default breadcrumb
    |--------------------------------------------------------------------------
    |
    | Whether enable default breadcrumb for every page content.
    */
    'enable_default_breadcrumb' => false,

    /*
    |--------------------------------------------------------------------------
    | Enable/Disable assets minify
    |--------------------------------------------------------------------------
    */
    'minify_assets' => [

        // Assets will not be minified.
        'excepts' => [

        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Enable/Disable sidebar menu search
    |--------------------------------------------------------------------------
    */
    'enable_menu_search' => false,

    /*
    |--------------------------------------------------------------------------
    | Alert message that will displayed on top of the page.
    |--------------------------------------------------------------------------
    */
    'top_alert' => '',

    /*
    |--------------------------------------------------------------------------
    | The global Grid action display class.
    |--------------------------------------------------------------------------
    */
//    'grid_action_class' => \Encore\Admin\Grid\Displayers\DropdownActions::class,

    /*
    |--------------------------------------------------------------------------
    | Extension Directory
    |--------------------------------------------------------------------------
    |
    | When you use command `php artisan admin:extend` to generate extensions,
    | the extension files will be generated in this directory.
    */
    'extension_dir' => admin_path('extensions'),

    /*
    |--------------------------------------------------------------------------
    | Settings for extensions.
    |--------------------------------------------------------------------------
    |
    | You can find all available extensions here
    | https://github.com/laravel-admin-extensions.
    |
    */
    'extensions' => [
        'media-manager' => [
            // Select a local disk that you configured in `config/filesystem.php`
            'disk' => 'public'
        ],
        'multi-language' => [
            'enable' => true,
            // the key should be same as var locale in config/app.php
            // the value is used to show
            'languages' => [
                'en' => 'English',
                'nl' => 'Nederlands',
                'ja' => 'Japanese',
            ],
            // default locale
            'default' => 'en',
        ],
        'data-table' => [
            // If the value is set to false, this extension will be disabled
            'enable' => true,
            // global options
            'options' => [
                'paging' => false,
                'lengthChange' => false,
                'searching' => false,
                'ordering' => false,
                'info' => false,
                'language' => 'English', // or Chinese
            ]
        ],
        'tinymce' => [
            // Set to false if you want to disable this extension
            'enable' => true,
            // Editor configuration
            'config' => [
                'resize'=> false,
                'convert_urls' => 0,
                'language'=> 'en_GB',
                'plugins'=> 'advlist autolink link image lists preview code help fullscreen table autoresize ',   // 插件
                'toolbar'=> 'undo redo | styleselect | fontsizeselect bold italic | link image blockquote removeformat | indent outdent bullist numlist code',   // 配置工具栏
                'images_upload_url'=> '/api/v1/images',  //图片上传接口  返回格式：{ location : "/demo/image/1.jpg" }
            ]
        ],
    ]
];
