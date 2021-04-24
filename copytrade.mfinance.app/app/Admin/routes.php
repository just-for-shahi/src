<?php

use App\Models\ManagerSetting;
use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resources([
        'users' => UserController::class,
        'apis' => ApiServerController::class,
        'brokers' => BrokerServerController::class,
        'symbols' => BrokerSymbolController::class,
        'managers' => MyManagerController::class,
        'userbrokerservers' => UserBrokerServerController::class,
        'accounts' => AccountController::class,
        'copiers' => CopierSubscriptionDestController::class,
        'orders' => OrderController::class,
        'copied' => OrderCopiedController::class,
        'broker-managers' => BrokerManagerController::class,
        'strategies' => StrategyController::class,
        'portfolios' => PortfolioController::class,
        'strategyorders' => StrategyOrderController::class,
        'stats' => TrackerStatController::class,
        'mystats' => MyStatController::class,
        'copiersubscriptions' => CopierSubscriptionController::class,
        'emailsubscriptions' => EmailSubscriptionController::class,
        'telegramsubscriptions' => TelegramSubscriptionController::class,
        'expertsubscriptions' => ExpertSubscriptionController::class,
        'useremailsubscriptions' => UserEmailSubscriptionController::class,
        'mycopiersubscriptions' => MyCopierSubscriptionController::class,
        'myemailsubscriptions' => MyEmailSubscriptionController::class,
        'myaccounts' => MyAccountController::class,
        'mytrades' => MyOrderController::class,
        'portfolio-trades' => PortfolioOrderController::class,
        'mycopiers' => MyCopierSubscriptionDestAccountController::class,
        'my-strategies' => MyStrategyController::class,
        'my-portfolios' => MyPortfolioController::class,
        'myapis' => MyApiServerController::class,

        'lusers' => LicensingUserController::class,
        'products' => ProductController::class,
        'poptions' => ProductOptionController::class,
        'pfiles' => ProductFileController::class,
        'pmaccounts' => ProductMemberAccountController::class,
        'campaigns' => CampaignController::class,
        'members' => MemberController::class,
        'cmembers' => CampaignMemberController::class,
        'laccounts' => AccountLiteController::class,

        'packages' => LicensePackageController::class,
        'tags' => ColoredTagController::class,

        'email_templates' => EmailTemplateController::class,
        'reports' => ReportController::class,
        'efiles' => FileController::class,
        'experts' => ExpertController::class,
        'accounttemplates' => AccountExpertTemplateController::class,
        'copiergroups' => CopierSubscriptionGroupController::class,
        'emailgroups' => EmailSubscriptionGroupController::class,
        'email_settings' => ManagerMailSettingController::class,

        'copier-errors' => CopierErrorController::class,

        'discordbotsubscriptions' => DiscordBotSubscriptionsController::class,
    ]);

    $router->get('email_settings', 'ManagerMailSettingController@index');
    $router->put('email_settings', 'ManagerMailSettingController@putSetting');

    $router->get('client-area', 'UserController@clientArea');
    $router->get('user/impersonate/{id}', 'UserController@impersonate');
    $router->get('user/deimpersonate', 'UserController@deimpersonate');
    $router->get('user/setting', 'UserController@getSetting')->name('admin.setting');
    $router->put('user/setting', 'UserController@putSetting');

    $router->post('orders/close_order', 'OrderController@close_order');
    $router->post('mytrades/close_order', 'MyOrderController@close_order');

    $router->get('myemailsubscriptions/subscribe/{id}', 'MyEmailSubscriptionController@subscribe');

    $router->get('api/mycopiers/account', 'MyCopierSubscriptionDestAccountController@account');
    $router->post('accounts/update_status', 'AccountController@update_status');
    $router->post('accounts/move_to', 'AccountController@move_to');
    $router->post('accounts/add2copier', 'AccountController@add2copier');
    $router->post('users/add2email_subscription', 'UserController@add2email_subscription');
    $router->post('users/add2copier_subscription', 'UserController@add2copier_subscription');

    $router->post('telegramsubscriptions/test', 'TelegramSubscriptionController@test');
    $router->post('emailsubscriptions/test', 'EmailSubscriptionController@test');
});