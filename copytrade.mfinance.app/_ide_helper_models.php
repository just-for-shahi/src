<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Account
 *
 * @method static where(string $string, $accountNumber)
 * @property int $id
 * @property int $user_id
 * @property int $account_number
 * @property int $copier_type
 * @property string $broker_server_name
 * @property int $account_status
 * @property string|null $api_server_ip
 * @property int $manager_id
 * @property string|null $name
 * @property string|null $title
 * @property string|null $password
 * @property string|null $company
 * @property string|null $version
 * @property string|null $last_error
 * @property string|null $old_api_server_ip
 * @property string|null $api_version
 * @property int|null $dbl_account_number
 * @property int $trade_allowed
 * @property int|null $symbol_trade_allowed
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property string|null $deleted_at
 * @property int $creator_id
 * @property int|null $build
 * @property int|null $jfx_mode
 * @property int|null $memc_mode
 * @property int|null $mem_ok
 * @property int|null $is_live
 * @property int|null $build_equity
 * @property int|null $processing
 * @property string|null $ws_host
 * @property-read \App\Models\ApiServer|null $api_server
 * @property-read \App\Models\BrokerServer $broker_server
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CopierSubscription[] $destinations
 * @property-read int|null $destinations_count
 * @property-read mixed $full_account_name
 * @property-read \App\User $manager
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CopierSubscription[] $sources
 * @property-read int|null $sources_count
 * @property-read \App\Models\AccountStat|null $stat
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account query()
 * @mixin \Eloquent
 */
	class Account extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AccountExpertTemplate
 *
 * @property int $id
 * @property int $expert_id
 * @property int|null $account_id
 * @property int|null $tpl_file_id
 * @property string $options
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $enabled
 * @property string $symbol
 * @property int $timeframe
 * @property int|null $is_updated_or_new
 * @property string|null $snapshot
 * @property int|null $load_status
 * @property-read \App\Models\Account|null $account
 * @property-read \App\Models\Expert $expert
 * @property-read \App\Models\File|null $template_file
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountExpertTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountExpertTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountExpertTemplate query()
 * @mixin \Eloquent
 * @property string|null $automation_file_options
 */
	class AccountExpertTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AccountRemoved
 *
 * @property int $id
 * @property int $account_number
 * @property string $password
 * @property string $broker_server_name
 * @property int $manager_id
 * @property int $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $trade_allowed
 * @property int|null $symbol_trade_allowed
 * @property string|null $last_error
 * @property int|null $is_live
 * @property int|null $copier_type
 * @property string|null $api_server_ip
 * @property-read \App\User $manager
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountRemoved newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountRemoved newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountRemoved query()
 * @mixin \Eloquent
 */
	class AccountRemoved extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AccountStat
 *
 * @property int $account_number
 * @property int|null $nof_closed
 * @property int|null $nof_winning
 * @property int|null $nof_lossing
 * @property float|null $win_ratio
 * @property float|null $net_pl
 * @property float|null $net_profit
 * @property float|null $gross_profit
 * @property float|null $gross_loss
 * @property float|null $profit_factor
 * @property int|null $weeks
 * @property float|null $worst_trade_dol
 * @property float|null $best_trade_dol
 * @property float|null $worst_trade_pips
 * @property float|null $best_trade_pips
 * @property int|null $nof_working
 * @property float|null $deposit
 * @property float|null $withdrawal
 * @property float|null $net_profit_pips
 * @property int|null $top_nof_closed
 * @property int|null $top_nof_winning
 * @property int|null $top_nof_lossing
 * @property float|null $top_win_ratio
 * @property float|null $top_net_profit
 * @property float|null $top_net_profit_pips
 * @property float|null $avg_win
 * @property float|null $avg_loss
 * @property float|null $avg_win_pips
 * @property float|null $avg_loss_pips
 * @property float|null $total_lots
 * @property float|null $total_commission
 * @property int|null $total_longs
 * @property int|null $total_shorts
 * @property int|null $longs_won
 * @property int|null $shorts_won
 * @property int|null $avg_trade_duration
 * @property int|null $total_days
 * @property float|null $avg_daily_return
 * @property float|null $interest
 * @property float|null $balance
 * @property string|null $currency
 * @property float|null $profit
 * @property float|null $equity
 * @property float|null $credit
 * @property int|null $mem
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $total_months
 * @property int|null $ping_ms
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property string|null $name
 * @property int|null $is_demo
 * @property-read \App\Models\Account $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountStat newModelstatement()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountStat newstatement()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountStat statement()
 * @mixin \Eloquent
 * @property float|null $monthly_perc
 * @property float|null $gain_perc
 * @property float|null $highest_dol
 * @property float|null $drawdown_perc
 * @property string|null $highest_date
 * @method static \Illuminate\Database\Eloquent\Builder|AccountStat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountStat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountStat query()
 */
	class AccountStat extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Activation
 *
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property string $ip_address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activation query()
 * @mixin \Eloquent
 */
	class Activation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ApiServer
 *
 * @property int $id
 * @property string $ip
 * @property string|null $title
 * @property int $api_server_status
 * @property int $mem
 * @property int $cpu
 * @property int $enabled
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property int|null $max_accounts
 * @property int|null $manager_id
 * @property string|null $host_name
 * @property int|null $max_processing_accounts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Account[] $accounts
 * @property-read int|null $accounts_count
 * @property-read \App\User|null $manager
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiServer enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiServer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiServer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiServer query()
 * @method static whereManagerId($id)
 * @mixin \Eloquent
 */
	class ApiServer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BrokerGroup
 *
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerGroup query()
 * @mixin \Eloquent
 */
	class BrokerGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BrokerManager
 *
 * @property int $id
 * @property string $ip
 * @property string $login
 * @property string $password
 * @property int|null $manager_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $enabled
 * @property int|null $port
 * @property int|null $broker_server_id
 * @property string|null $api_host
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerManager enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerManager newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerManager newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerManager query()
 * @mixin \Eloquent
 */
	class BrokerManager extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BrokerServer
 *
 * @property int $id
 * @property string $name
 * @property mixed $srv_file
 * @property string|null $suffix
 * @property int|null $is_updated_or_new
 * @property int|null $gmt_offset
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property string|null $srv_file_path
 * @property int|null $api_or_manager
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Account[] $accounts
 * @property-read int|null $accounts_count
 * @property-read \App\Models\UserBrokerServer|null $userServer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerServer api()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerServer enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerServer manager()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerServer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerServer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerServer query()
 * @mixin \Eloquent
 */
	class BrokerServer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BrokerSymbol
 *
 * @property string $name
 * @property float|null $spread
 * @property int|null $enabled
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerSymbol enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerSymbol newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerSymbol newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerSymbol query()
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
	class BrokerSymbol extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BrokerUser
 *
 * @property int $user_id
 * @property string $group
 * @property string|null $reg_date
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerUser query()
 * @mixin \Eloquent
 */
	class BrokerUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Campaign
 *
 * @property int $id
 * @property int $manager_id
 * @property string $title
 * @property string|null $description
 * @property string|null $slug
 * @property string $expired_at
 * @property int|null $max_live_accounts
 * @property int|null $max_demo_accounts
 * @property int|null $single_pc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $auto_confirm_new_accounts
 * @property-read \App\User $manager
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Campaign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Campaign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Campaign query()
 * @mixin \Eloquent
 */
	class Campaign extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CopierSubscription
 *
 * @property int $id
 * @property int $manager_id
 * @property string $title
 * @property int|null $risk_type
 * @property float|null $fixed_lot
 * @property float|null $max_risk
 * @property float|null $lots_multiplier
 * @property float|null $money_ratio_lots
 * @property float|null $money_ratio_dol
 * @property int|null $max_lots_per_trade
 * @property float|null $price_diff_accepted_pips
 * @property int|null $max_open_positions
 * @property int|null $copier_delay
 * @property string|null $memc_servers
 * @property float|null $min_balance
 * @property int|null $live_time
 * @property int|null $scaling_factor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $creator_id
 * @property string|null $scope_key
 * @property int|null $allow_partial_close
 * @property int|null $lots_formula
 * @property string|null $pairs_matching
 * @property int|null $copier_subscription_group_id
 * @property-read \App\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Account[] $destination
 * @property-read int|null $destination_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Account[] $sources
 * @property-read int|null $sources_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $subscribers
 * @property-read int|null $subscribers_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CopierSubscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CopierSubscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CopierSubscription query()
 * @method static whereManagerId($id)
 * @mixin \Eloquent
 */
	class CopierSubscription extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CopierSubscriptionDestAccount
 *
 * @property int $id
 * @property int|null $copier_subscription_id
 * @property int|null $account_id
 * @property float|null $fixed_lot
 * @property float|null $lots_multiplier
 * @property float|null $max_lots_per_trade
 * @property float|null $max_risk
 * @property float|null $price_diff_accepted_pips
 * @property int|null $max_open_positions
 * @property int|null $risk_type
 * @property float|null $money_ratio_lots
 * @property float|null $money_ratio_dol
 * @property float|null $min_balance
 * @property int|null $live_time
 * @property int|null $enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Account|null $account
 * @property-read \App\Models\BrokerServer|null $broker_server
 * @property-read \App\User $creator
 * @property-read \App\Models\CopierSubscription|null $subscription
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CopierSubscriptionDestAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CopierSubscriptionDestAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CopierSubscriptionDestAccount query()
 * @mixin \Eloquent
 * @property int|null $scaling_factor
 */
	class CopierSubscriptionDestAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CopierSubscriptionGroup
 *
 * @property int $id
 * @property string $title
 * @property int|null $enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $manager_id
 * @property-read \App\User|null $manager
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CopierSubscription[] $subscriptions
 * @property-read int|null $subscriptions_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CopierSubscriptionGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CopierSubscriptionGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CopierSubscriptionGroup query()
 * @mixin \Eloquent
 */
	class CopierSubscriptionGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CopierSubscriptionSourceAccount
 *
 * @property int $id
 * @property int $copier_subscription_id
 * @property int $account_id
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property-read \App\Models\Account $accounts
 * @property-read \App\Models\CopierSubscription $subscription
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CopierSubscriptionSourceAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CopierSubscriptionSourceAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CopierSubscriptionSourceAccount query()
 * @mixin \Eloquent
 */
	class CopierSubscriptionSourceAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EmailSubscription
 *
 * @property int $id
 * @property int $manager_id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $template_signal_new
 * @property string|null $template_signal_updated
 * @property string|null $template_signal_closed
 * @property-read \App\User $manager
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Account[] $sources
 * @property-read int|null $sources_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailSubscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailSubscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailSubscription query()
 * @method static whereManagerId($id)
 * @mixin \Eloquent
 */
	class EmailSubscription extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EmailSubscriptionGroup
 *
 * @property int $id
 * @property string $title
 * @property int|null $enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $manager_id
 * @property-read \App\User|null $manager
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EmailSubscription[] $subscriptions
 * @property-read int|null $subscriptions_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailSubscriptionGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailSubscriptionGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailSubscriptionGroup query()
 * @mixin \Eloquent
 */
	class EmailSubscriptionGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EmailSubscriptionSourceAccount
 *
 * @property int $id
 * @property int $email_subscription_id
 * @property int $account_id
 * @property-read \App\Models\Account $accounts
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailSubscriptionSourceAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailSubscriptionSourceAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailSubscriptionSourceAccount query()
 * @mixin \Eloquent
 */
	class EmailSubscriptionSourceAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Expert
 *
 * @property int $id
 * @property string $name
 * @property int $ex4_file_id
 * @property int $manager_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $enabled
 * @property string $template_default
 * @property int|null $automation_file_id
 * @property-read \App\Models\File|null $automation_file
 * @property-read \App\Models\File $ex4_file
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Expert newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Expert newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Expert query()
 * @mixin \Eloquent
 */
	class Expert extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ExpertSubscription
 *
 * @property int $id
 * @property int $manager_id
 * @property string $title
 * @property int|null $count_templates
 * @property int|null $enabled
 * @property int|null $expire_days
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Expert[] $experts
 * @property-read int|null $experts_count
 * @property-read \App\User $manager
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExpertSubscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExpertSubscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExpertSubscription query()
 * @mixin \Eloquent
 */
	class ExpertSubscription extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ExpertSubscriptionExpert
 *
 * @property int $id
 * @property int $expert_id
 * @property int $expert_subscription_id
 * @property-read \App\Models\Expert $expert
 * @property-read \App\Models\ExpertSubscription $subscription
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExpertSubscriptionExpert newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExpertSubscriptionExpert newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExpertSubscriptionExpert query()
 * @mixin \Eloquent
 */
	class ExpertSubscriptionExpert extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\File
 *
 * @property int $id
 * @property string|null $path
 * @property mixed $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $type
 * @property int|null $is_updated_or_new
 * @property string $name
 * @property int $manager_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File query()
 * @mixin \Eloquent
 */
	class File extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LicensePreset
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $expiration_days
 * @property int|null $max_live_accounts
 * @property int|null $max_demo_accounts
 * @property int|null $single_pc
 * @property string|null $broker_name
 * @property int $manager_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $auto_confirm_new_accounts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserBrokerServer[] $brokers
 * @property-read int|null $brokers_count
 * @property-read \App\User $manager
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LicensePreset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LicensePreset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LicensePreset query()
 * @method static whereManagerId(int $id)
 * @mixin \Eloquent
 */
	class LicensePreset extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Licensing
 *
 * @property mixed user_id
 * @method whereHas(string $string, \Closure $param)
 * @property int $id
 * @property int $user_id
 * @property int|null $affiliate_id
 * @property int|null $campaign_id
 * @property string|null $reference_source
 * @property-read \App\Models\Campaign|null $campaign
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Licensing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Licensing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Licensing query()
 * @mixin \Eloquent
 */
	class Licensing extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LicensingUser
 *
 * @property int $id
 * @property int|null $manager_id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string|null $avatar
 * @property string|null $remember_token
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $creator_id
 * @property string|null $email
 * @property string|null $api_token
 * @property mixed|null $meta
 * @property string|null $theme
 * @property mixed|null $trusted_hosts
 * @property int|null $activated
 * @property string|null $signup_ip
 * @property string|null $signup_confirmation_ip
 * @property string|null $signup_sm_ip
 * @property string|null $last_login_at
 * @property string|null $last_login_ip
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Account[] $accounts
 * @property-read int|null $accounts_count
 * @property-read \App\Models\Campaign|null $campaign
 * @property-read \App\Models\Licensing|null $licensing
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LicensingUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LicensingUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LicensingUser query()
 * @mixin \Eloquent
 * @property string|null $note
 */
	class LicensingUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ManagerMailSetting
 *
 * @method static find(int $id)
 * @property int $manager_id
 * @property string|null $driver
 * @property string|null $smtp_host
 * @property int|null $smtp_port
 * @property string|null $smtp_encryption
 * @property string|null $smtp_username
 * @property string|null $smtp_password
 * @property string|null $from_email
 * @property string|null $from_name
 * @property string|null $main_template
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User $manager
 * @method static \Illuminate\Database\Eloquent\Builder|ManagerMailSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ManagerMailSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ManagerMailSetting query()
 * @mixin \Eloquent
 */
	class ManagerMailSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ManagerMailTemplate
 *
 * @property int $id
 * @property string $mailable
 * @property string|null $subject
 * @property string $html_template
 * @property string|null $text_template
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $manager_id
 * @property-read array $variables
 * @property-read \App\User|null $manager
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ManagerMailTemplate forMailable(\Illuminate\Contracts\Mail\Mailable $mailable)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ManagerMailTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ManagerMailTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ManagerMailTemplate query()
 * @method whereManagerId(int $id)
 * @mixin \Eloquent
 * @property string|null $tag
 */
	class ManagerMailTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ManagerSetting
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $max_copiers
 * @property int|null $max_senders
 * @property int|null $max_followers
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $can_edit_brokers
 * @property int|null $create_default_subscription
 * @property-read \Illuminate\Database\Eloquent\Collection|Account[] $accounts
 * @property-read int|null $accounts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|CopierSubscription[] $copiers
 * @property-read int|null $copiers_count
 * @property-read mixed $copier_count
 * @property-read mixed $follower_count
 * @property-read mixed $sender_count
 * @property-read User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|ManagerSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ManagerSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ManagerSetting query()
 * @mixin \Eloquent
 */
	class ManagerSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Member
 *
 * @property int $id
 * @property int $user_id
 * @property string $license_key
 * @property int|null $expiration_days
 * @property int|null $max_live_accounts
 * @property int|null $max_demo_accounts
 * @property int|null $single_pc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $expired_at
 * @property int|null $auto_confirm_new_accounts
 * @property string|null $activated_at
 * @property string|null $MAC
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Account[] $accounts
 * @property-read int|null $accounts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserBrokerServer[] $brokers
 * @property-read int|null $brokers_count
 * @property-read \App\User|null $manager
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member query()
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 */
	class Member extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MemberProduct
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $member_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Member|null $member
 * @property-read \App\Models\Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberProduct query()
 * @mixin \Eloquent
 */
	class MemberProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MemberProductAccount
 *
 * @method static where(string $string, int $productId)
 * @property int $id
 * @property int $product_id
 * @property int $account_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $confirmed
 * @property int $member_id
 * @property-read \App\Models\Account $account
 * @property-read \App\Models\Member $member
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\AccountStat|null $stat
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberProductAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberProductAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberProductAccount query()
 * @mixin \Eloquent
 */
	class MemberProductAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $ticket
 * @property int $account_number
 * @property int $status
 * @property string|null $symbol
 * @property int|null $type
 * @property string|null $type_str
 * @property float|null $lots
 * @property float|null $price
 * @property float|null $stoploss
 * @property float|null $takeprofit
 * @property string|null $time_close
 * @property float|null $price_close
 * @property float|null $pl
 * @property string|null $time_open
 * @property string|null $time_last_action
 * @property int|null $magic
 * @property float $pips
 * @property float|null $swap
 * @property int $last_error_code
 * @property string|null $last_error
 * @property string $time_created
 * @property float|null $commission
 * @property string|null $comment
 * @property float|null $sl_pips
 * @property float|null $sl_dol
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property int|null $strategy_id
 * @property-read \App\Models\Account $account
 * @property-read \App\Models\Account|null $account_stat
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order closed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order countable()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order countableClosed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order market()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order marketClosed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @mixin \Eloquent
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderEquity
 *
 * @property int $id
 * @property int $account_number
 * @property string $date_at
 * @property float $pl
 * @property float|null $pips
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderEquity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderEquity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderEquity query()
 * @mixin \Eloquent
 */
	class OrderEquity extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $key
 * @property string $title
 * @property string|null $description
 * @property int|null $manager_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $version
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductFile[] $files
 * @property-read int|null $files_count
 * @property-read \App\User|null $manager
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductOption[] $opts
 * @property-read int|null $opts_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product query()
 * @method static whereManagerId($id)
 * @mixin \Eloquent
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductFile
 *
 * @property int $id
 * @property string $name
 * @property string $path
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductFile query()
 * @mixin \Eloquent
 * @property string|null $type
 */
	class ProductFile extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductOption
 *
 * @method static whereProductId($productId)
 * @property int $id
 * @property int|null $product_id
 * @property string $pkey
 * @property string $val
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $enabled
 * @property-read \App\Models\Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductOption query()
 * @mixin \Eloquent
 */
	class ProductOption extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Profile
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $location
 * @property string|null $bio
 * @property string|null $twitter_username
 * @property string|null $github_username
 * @property string|null $avatar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Theme|null $theme
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile query()
 * @mixin \Eloquent
 */
	class Profile extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Social
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $provider
 * @property string|null $social_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social query()
 * @mixin \Eloquent
 */
	class Social extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Strategy
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $manager_id
 * @property string|null $file_name
 * @property int|null $account_number
 * @property-read \App\Models\Account|null $account
 * @property-read \App\User $manager
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \App\Models\Order|null $ordersCount
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Strategy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Strategy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Strategy query()
 * @mixin \Eloquent
 */
	class Strategy extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StrategyOrder
 *
 * @property int $ticket
 * @property int $account_number
 * @property int $status
 * @property string|null $symbol
 * @property int|null $type
 * @property string|null $type_str
 * @property float|null $lots
 * @property float|null $price
 * @property float|null $stoploss
 * @property float|null $takeprofit
 * @property string|null $time_close
 * @property float|null $price_close
 * @property float|null $pl
 * @property string|null $time_open
 * @property string|null $time_last_action
 * @property int|null $magic
 * @property float $pips
 * @property float|null $swap
 * @property int $last_error_code
 * @property string|null $last_error
 * @property string $time_created
 * @property float|null $commission
 * @property string|null $comment
 * @property float|null $sl_pips
 * @property float|null $sl_dol
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property int|null $strategy_id
 * @property-read \App\Models\Strategy|null $strategy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StrategyOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StrategyOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StrategyOrder query()
 * @mixin \Eloquent
 */
	class StrategyOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Tag
 *
 * @property int $id
 * @property string $title
 * @property string $color
 * @property int $manager_id
 * @property int|null $enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $manager
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag query()
 * @method static whereManagerId($id)
 * @mixin \Eloquent
 */
	class Tag extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TelegramSubscription
 *
 * @property int $id
 * @property string $title
 * @property string $bot_api_token
 * @property int $manager_id
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property string $channel_id
 * @property string|null $template_signal_new
 * @property string|null $template_signal_updated
 * @property string|null $template_signal_closed
 * @property-read \App\User $manager
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Account[] $sources
 * @property-read int|null $sources_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramSubscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramSubscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramSubscription query()
 * @mixin \Eloquent
 * @property string|null $template_signal_closed_profit
 * @property string|null $template_signal_closed_lost
 * @property string|null $template_signal_closed_breakeven
 * @property string|null $template_signal_canceled
 * @property string|null $template_overview_week
 * @property string|null $template_overview_month
 * @property string|null $template_overview_quartal
 * @property string|null $template_overview_half_year
 * @property string|null $template_overview_year
 * @property string|null $tag
 */
	class TelegramSubscription extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TelegramSubscriptionSourceAccount
 *
 * @property int $id
 * @property int $telegram_subscription_id
 * @property int $account_id
 * @property-read \App\Models\Account $accounts
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramSubscriptionSourceAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramSubscriptionSourceAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramSubscriptionSourceAccount query()
 * @mixin \Eloquent
 */
	class TelegramSubscriptionSourceAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Theme
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Profile[] $profile
 * @property-read int|null $profile_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Theme newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Theme newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Theme onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Theme query()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Theme withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Theme withoutTrashed()
 * @mixin \Eloquent
 */
	class Theme extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserBrokerServer
 *
 * @property int $broker_server_id
 * @property int $user_id
 * @property int|null $enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $id
 * @property-read \App\Models\BrokerServer $broker_server
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBrokerServer enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBrokerServer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBrokerServer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserBrokerServer query()
 * @mixin \Eloquent
 */
	class UserBrokerServer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserCopierSubscription
 *
 * @property int $id
 * @property int $user_id
 * @property int $copier_subscription_id
 * @property string|null $expired_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CopierSubscription $subscription
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCopierSubscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCopierSubscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCopierSubscription query()
 * @mixin \Eloquent
 */
	class UserCopierSubscription extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserEmailSubscription
 *
 * @property int $user_id
 * @property int $email_subscription_id
 * @property int|null $enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $email
 * @property int $id
 * @property-read \App\User $manager
 * @property-read \App\Models\EmailSubscription $subscription
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEmailSubscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEmailSubscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEmailSubscription query()
 * @mixin \Eloquent
 */
	class UserEmailSubscription extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserExpertSubscription
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $expert_subscription_id
 * @property string|null $expired_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $manager
 * @property-read \App\Models\ExpertSubscription|null $subscription
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserExpertSubscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserExpertSubscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserExpertSubscription query()
 * @mixin \Eloquent
 */
	class UserExpertSubscription extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserSubscriptionSetting
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $max_email_subscriptions
 * @property int|null $max_copier_subscriptions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $max_accounts
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSubscriptionSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSubscriptionSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSubscriptionSetting query()
 * @mixin \Eloquent
 */
	class UserSubscriptionSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WsHost
 *
 * @property int $id
 * @property string $host
 * @property int|null $manager_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Account[] $accounts
 * @property-read int|null $accounts_count
 * @property-read \App\User|null $manager
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WsHost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WsHost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WsHost query()
 * @method static whereManagerId($id)
 * @mixin \Eloquent
 */
	class WsHost extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @method static firstOrCreate(array $array, array $array1)
 * @property int $id
 * @property int|null $manager_id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string|null $avatar
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $creator_id
 * @property string|null $email
 * @property string|null $api_token
 * @property array|null $meta
 * @property string|null $theme
 * @property array|null $trusted_hosts
 * @property int|null $activated
 * @property string|null $signup_ip
 * @property string|null $signup_confirmation_ip
 * @property string|null $signup_sm_ip
 * @property string|null $last_login_at
 * @property string|null $last_login_ip
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Account[] $accounts
 * @property-read int|null $accounts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CopierSubscription[] $copiersubscriptions
 * @property-read int|null $copiersubscriptions_count
 * @property-read \App\User|null $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EmailSubscription[] $emailsubscriptions
 * @property-read int|null $emailsubscriptions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ExpertSubscription[] $expertsubscriptions
 * @property-read int|null $expertsubscriptions_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Encore\Admin\Auth\Database\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \App\Models\Profile|null $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\Encore\Admin\Auth\Database\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Social[] $social
 * @property-read int|null $social_count
 * @property-read \App\Models\UserSubscriptionSetting|null $subscriptionsettings
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static whereManagerId($id)
 * @mixin \Eloquent
 * @property string|null $note
 * @property-read mixed $is_admin
 */
	class User extends \Eloquent implements \Tymon\JWTAuth\Contracts\JWTSubject {}
}

