<?php

//use App\Http\Controllers\Api\ReportController;

Route::group([
    'middleware' => ['apilogger'],
    'namespace' => 'Api',
    'prefix' => 'reports'], static function() {
        Route::get('equity/{accountNumber}', 'ReportController@equity');
        Route::get('stat/{accountNumber}', 'ReportController@stat');
        Route::get('advanced/{accountNumber}', 'ReportController@advanced');
    Route::get('weekly/{accountNumber}', 'ReportController@weekly');
});

Route::group([
	'middleware'  => ['auth:trusted_host','apilogger'],
	'namespace' => 'Api',
	'prefix' => 'widgets'], static function() {
	Route::get('check_trusted', 'WidgetController@check_trusted');
	Route::get('list_accounts', 'WidgetController@list_accounts');

	Route::get('equity/{accountNumber}', 'WidgetController@equity');
	Route::get('instruments/{accountNumber}', 'WidgetController@instruments');
	Route::get('advstat/{accountNumber}', 'WidgetController@advstat');
	Route::get('history/{accountNumber}', 'WidgetController@history');

	Route::get('portfolios', 'WidgetController@listPortfolios');
	Route::get('portfolio/equity/{portfolioId}', 'WidgetController@equityPortfolio');
	Route::get('portfolio/instruments/{portfolioId}', 'WidgetController@instrumentsPortfolio');
	Route::get('portfolio/advstat/{portfolioId}', 'WidgetController@advstatPortfolio');
	Route::get('portfolio/history/{portfolioId}/{limit}', 'WidgetController@historyPortfolio');
} );

Route::group(['middleware'  => ['auth:api','apilogger']], static function() {
	Route::post('licensing/auth', 'Api\LicensingController@auth');
	Route::post('licensing/campaign', 'Api\LicensingController@campaign');
	Route::post('licensing/detachAccount', 'Api\LicensingController@detachAccount');
	Route::post('licensing/productPutFile', 'Api\LicensingController@productPutFile');
	Route::get('licensing/ping', 'Api\AuthController@ping');
	Route::get('licensing/packages', 'Api\LicensingController@listPackages');
	Route::post('licensing/member/add', 'Api\LicensingController@addMember');
	Route::post('licensing/member/delete', 'Api\LicensingController@deleteMember');

	Route::get('widgets/add_trusted', 'Api\WidgetController@add_trusted');
	Route::post('kartra/process', 'Api\KartraController@process');

	Route::get('copiers/add', 'Api\CopierController@add');
	Route::get('users/details/{id}', 'Api\UserController@details');
	Route::get('/ping', 'Api\AuthController@ping');
	Route::post('accounts/get_or_create', 'Api\AccountController@getOrCreate');
	Route::get('accounts/update_status/{id}/{status}', 'Api\AccountController@updateStatus');
	Route::get('accounts/update_status_by_number/{accountNumber}/{status}', 'Api\AccountController@updateStatusByNumber');
	Route::post('accounts/upload_stat/{accountNumber}', 'Api\AccountController@uploadStat');
	Route::get('users/debug', 'Api\UserController@debug');
	Route::post('users/create', 'Api\UserController@create');
	Route::get('users/remove/{id}', 'Api\UserController@remove');
	Route::get('users/removebyemail/{email}', 'Api\UserController@removeByEmail');
	Route::get('users/detailsbyemail/{email}', 'Api\UserController@detailsByEmail');
	Route::post('brokers/process/{broker_id}/{api_server_id}', 'Api\BrokerManagerController@process');
	Route::post('orders/process', 'Api\OrderController@process');
	Route::get('orders/get_unsync_tickets/{accountNumber}/{limit}', 'Api\OrderController@getUnsyncTickets');
	Route::post('orders/upload/{accountNumber}/{ticket}', 'Api\OrderController@upload');
	Route::post('orders/upload_tickets/{accountNumber}', 'Api\OrderController@uploadTickets');

	Route::get('emailsubscriptions/groups/{id}', 'Api\EmailSubscriptionController@getGroup');
	Route::get('emailsubscriptions/groups', 'Api\EmailSubscriptionController@groupsAll');
	Route::post('emailsubscriptions/create4group', 'Api\EmailSubscriptionController@createForGroup');
	//Route::post('emailsubscriptions/delete4group', 'Api\EmailSubscriptionController@deleteForGroup');
	Route::get('emailsubscriptions', 'Api\EmailSubscriptionController@listAll');
	Route::get('emailsubscriptions/get/{id}', 'Api\EmailSubscriptionController@get');
	Route::post('emailsubscriptions/create', 'Api\EmailSubscriptionController@create');
	Route::post('emailsubscriptions/delete', 'Api\EmailSubscriptionController@delete');

	Route::get('copiersubscriptions/groups/{id}', 'Api\CopierSubscriptionController@getGroup');
	Route::get('copiersubscriptions/groups', 'Api\CopierSubscriptionController@groupsAll');
	Route::post('copiersubscriptions/create4group', 'Api\CopierSubscriptionController@createForGroup');
	Route::post('copiersubscriptions/delete4group', 'Api\CopierSubscriptionController@deleteForGroup');
	Route::get('copiersubscriptions', 'Api\CopierSubscriptionController@listAll');
	Route::get('copiersubscriptions/get/{id}', 'Api\CopierSubscriptionController@get');
	Route::get('copiersubscriptions/get_for_master/{accountIdMaster}', 'Api\CopierSubscriptionController@getForMaster');
	Route::get('copiersubscriptions/get_for_slave/{accountIdSlave}', 'Api\CopierSubscriptionController@getForSlave');
	Route::post('copiersubscriptions/create', 'Api\CopierSubscriptionController@create');
	Route::post('copiersubscriptions/delete', 'Api\CopierSubscriptionController@delete');

	Route::post('infusion/add', 'Api\InfusionController@add');
	Route::post('infusion/remove', 'Api\InfusionController@remove');

	Route::post('paddle/process', 'Api\PaddleController@process');
	Route::post('paddle/test', 'Api\PaddleController@test');
} );

Route::middleware('apilogger')->post('register', 'Api\AuthController@register');
Route::middleware('apilogger')->post('auth/login', 'Api\AuthController@login');
Route::middleware('apilogger')->get('auth/login', 'Api\AuthController@login');
Route::middleware('apilogger')->post('recover', 'Api\AuthController@recover');

Route::group(['middleware' => ['apilogger','jwt.verify']], function() {
	Route::get('orders/{accountId}', 'Api\OrderController@list');
	Route::post('orders/close/{accountNumber}', 'Api\OrderController@close');
	Route::get('logout', 'Api\AuthController@logout');
	Route::get('details', 'Api\UserController@mydetails');
	Route::get('brokers', 'Api\BrokerController@listAll');
	Route::get('brokers/{id}', 'Api\BrokerController@get');
    Route::post('brokers/update_state/{id}', 'Api\BrokerController@updateState');
	Route::get('accounts', 'Api\AccountController@listAll');
	Route::get('accounts/{id}', 'Api\AccountController@get');
	Route::get('accounts/realtime/{id}', 'Api\AccountController@getRealTime');
	Route::post('accounts/create', 'Api\AccountController@create');
	Route::get('accounts/delete/{id}', 'Api\AccountController@delete');
	Route::post('accounts/update/{id}', 'Api\AccountController@update');
    Route::get('experts', 'Api\ExpertController@listAll');
    Route::get('experts/{id}', 'Api\ExpertController@get');
	Route::post('experts/update_state/{id}', 'Api\ExpertController@updateState');

	Route::get('symbols', 'Api\BrokerSymbolController@listAll');
    Route::get('templates', 'Api\TemplateController@listAll');
	Route::get('templates/{id}', 'Api\TemplateController@get');
	Route::post('templates/create', 'Api\TemplateController@create');
	Route::post('templates/update_state/{id}', 'Api\TemplateController@updateState');
	Route::get('templates/delete/{id}', 'Api\TemplateController@delete');

    Route::get('expertsubscriptions', 'Api\ExpertSubscriptionController@listAll');
    Route::get('expertsubscriptions/{id}', 'Api\ExpertSubscriptionController@get');
    Route::post('expertsubscriptions/update_state/{id}', 'Api\ExpertSubscriptionController@updateState');
});
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('strategies', function (Request $request) {
	$strategies = Strategy::where('enabled',1)->get(array('id', 'name'));

    return Response::json(array('strategies'=>$strategies->toArray()));

    //return 'test: '.$request->get('v');
});

Route::get('strategy-orders', function (Request $request) {
	$strategy_id = $request->get('id');
	$limit = $request->get('limit');
	$symbol = $request->get('symbol');
	$long = $request->get('long');
	$short = $request->get('short');
	$win = $request->get('win');
	$loss = $request->get('loss');
	$sl = $request->get('sl');
	$tp = $request->get('tp');

/*    "&w1_5=" + (int)ShowWinningPips1_5 +
    "&w6_10=" + (int)ShowWinningPips6_10 +
    "&w11_20=" + (int)ShowWinningPips11_20 +
    "&w21_30=" + (int)ShowWinningPips21_30 +
    "&w31_50=" + (int)ShowWinningPips31_50 +
    "&w51=" + (int)ShowWinningPips50 +
    "&l1_5=" + (int)ShowLosingPips1_5 +
    "&l6_10=" + (int)ShowLosingPips6_10 +
    "&l11_20=" + (int)ShowLosingPips11_20 +
    "&l21_30=" + (int)ShowLosingPips21_30 +
    "&l31_50=" + (int)ShowLosingPips31_50 +
    "&l51=" + (int)ShowLosingPips50 * /

	$strategy_orders = StrategyOrder::where([
		['strategy_id',$strategy_id],
		['symbol',$symbol]
		])
	->where(function ($query) use ($long, $short) {
			if($long) {
				if(!$short)
                	$query->where('type', 0);
                else
                	$query->whereIn('type', [0,1]);
            } else {
				if($short)
                	$query->where('type', 1);
            }

        })
	->where(function ($query) use ($win, $loss) {
			if($win) {
				if(!$loss)
               		$query->where('pips', '>=', '0');
            } else {
				if($loss)
               		$query->where('pips', '<', '0');
            }
        })
	->where(function ($query) use ($sl, $tp) {
			if($sl) {
				if(!$tp)
					$query->whereColumn('price_close', 'stoploss');
			} else {
				if($tp)
	               	$query->whereColumn('price_close', 'takeprofit');
			}

        })
	->limit($limit)->get(array('id', 'ticket', 'price','price_close','time_open','time_close','stoploss','takeprofit', 'type', 'pl', 'pips'));

    return Response::json(array('status'=>200, 'orders' => $strategy_orders->toArray()));

    //return 'test: '.$request->get('v');
});*/