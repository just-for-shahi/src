<?php

namespace App\Helpers;

use App\Enums\MT4_RunReturn;

use App\Enums\MT4_RunReturnType;
use App\Helpers\MT4Client;
use WebSocket\Client;

class MT4Commands
{

    public static function wsSendOrderCloseSignal($accountNumber, $tickets) {
        $data['channel'] = $accountNumber;
        $data['signal'] = 'close';
        $data['tickets'] = $tickets;
        $ws_host = config('admin.ws_host');

        return self::wsSendCommand($ws_host, \json_encode($data), true);
    }

    public static function wsSendCommand($host, $message, bool $emptyRead = false)
    {
        $client = new Client($host);
        $client->send($message);

        if($emptyRead)
            return true;

        return $client->receive();
    }

    /**
     * Run mt4 account on API server with defined broker, account number and password
     *
     * @param string $api_server_ip
     * @param string $broker_server_name
     * @param int $account_number
     * @param string $password
     * @param array $config
     * @return MT4_RunReturn
     */
    public static function run($api_server_ip, $broker_server_name, $apiToken, $jfxMode, $accountId, $account_number, $password)
    {

        try {
            $mt4 = new MT4Client();

            $config = array();

//            $config['host'] = Str::replaceFirst( 'https', 'http', config('app.url'));
            $config['host'] = config('app.url');
            $config['token'] = $apiToken;
            $config['account_id'] = $accountId;

            $config['ws_host'] = config('admin.ws_host');
            $config['dbg'] = config('copier.jfx_debug');
            $config['last_orders'] = (int)config('copier.monitor_last_orders');
            $config['jfx_mode'] = $jfxMode;
            $config['delay_ms'] = (int)config('copier.delay_ms');

            $config['mysql_host'] = config('copier.db_host');
            $config['mysql_port'] = (int) config('database.connections.mysql.port');
            $config['mysql_db'] = config('database.connections.mysql.database');
            $config['mysql_user'] = config('database.connections.mysql.username');
            $config['mysql_pwd'] = config('database.connections.mysql.password');
            $config = json_encode($config);

            $mt4->init($api_server_ip);
            $ret = $mt4->run($broker_server_name, $account_number, $password, $config);
        } catch (\Exception $e) {
            if (strpos($e->getMessage(), 'Error Fetching http headers') !== false || strpos($e->getMessage(), 'Session expired') !== false) {
                return new MT4_RunReturn(MT4_RunReturnType::FAILED_REPEATABLE, $e->getMessage());
            }

            return new MT4_RunReturn(MT4_RunReturnType::FAILED, $e->getMessage());
        }

        if ($ret == false) {
            return new MT4_RunReturn(MT4_RunReturnType::FAILED_REPEATABLE, 'Failed to call mt4 run');
        }

        if (is_object($ret)) {
            return new MT4_RunReturn(MT4_RunReturnType::FAILED_REPEATABLE, 'Object returned: ' . serialize($ret));
        }

        if ($ret == 'OK, started' || $ret == 'OK') {
            return new MT4_RunReturn(MT4_RunReturnType::OK);
        }

        if (strpos($ret, 'Invalid user name or password') !== false) {
            return new MT4_RunReturn(MT4_RunReturnType::FAILED | MT4_RunReturnType::FAILED_W_ALERT, 'Invalid user name or password');
        }

        if (
            $ret == ''
            || strpos($ret, 'Unexpected error') !== false
            || strpos($ret, 'NOK') !== false
            || strpos($ret, 'Session expired') !== false
            || strpos($ret, 'Error Fetching http headers') !== false
            || strpos($ret, 'SOAP-ERROR: Parsing WSDL') !== false
        ) {
            return new MT4_RunReturn(MT4_RunReturnType::FAILED_REPEATABLE, $ret);
        }

        if (strpos($ret, 'Reached max number of terminals') !== false) {
            return new MT4_RunReturn(MT4_RunReturnType::FAILED_REPEATABLE | MT4_RunReturnType::FAILED_W_ALERT, $ret);
        }

        if (strpos($ret, 'SRV file not found: com.jfx.ts.net.SrvFileNotFound') !== false) {
            $name = str_replace('SRV file not found: com.jfx.ts.net.SrvFileNotFound:', '', $ret);
            return new MT4_RunReturn(
                MT4_RunReturnType::FAILED_W_ALERT | MT4_RunReturnType::FAILED_REPEATABLE,
                "Broker server file is not found: '$name'"
            );
        }

        return new MT4_RunReturn(MT4_RunReturnType::FAILED, 'Unhandled Error.' . $ret);
    }

    public static function host_info($api_server_ip)
    {
        $mt4 = new MT4Client();
        $mt4->init($api_server_ip);
        $info = $mt4->info();

        return $info->hostName;
    }

    public static function stop($api_server_ip, $broker_server_name, $account_number, $password)
    {
        try {
            $mt4 = new MT4Client();

            $mt4->init($api_server_ip);
            $ret = $mt4->stop($broker_server_name, $account_number, $password);

            if (
                strpos($ret, 'Session expired') !== false
                || strpos($ret, 'Error Fetching http headers') !== false
            ) {
                return new MT4_RunReturn(MT4_RunReturnType::FAILED_REPEATABLE, $ret);
            }
        } catch (\Exception $e) {
            if (
                strpos($e->getMessage(), 'Error Fetching http headers') !== false
                || strpos($e->getMessage(), 'Session expired') !== false
            ) {
                return new MT4_RunReturn(MT4_RunReturnType::FAILED_REPEATABLE, $e->getMessage());
            }

            return new MT4_RunReturn(MT4_RunReturnType::FAILED, $e->getMessage());
        }

        return new MT4_RunReturn(MT4_RunReturnType::OK);
    }

    public static function check($api_server_ip, $broker_server_name, $account_number, $password)
    {

        try {
            $mt4 = new MT4Client();

            $mt4->init($api_server_ip);
            $ret = $mt4->check($broker_server_name, $account_number, $password);
            if (
                strpos($ret, 'Invalid user name or password') !== false
                || strpos($ret, 'NOK') !== false
            ) {
                return new MT4_RunReturn(MT4_RunReturnType::ACCOUNT_INVALID, 'Wrong login or password');
            }

            if (
                strpos($ret, 'Session expired') !== false
                || strpos($ret, 'Error Fetching http headers') !== false
                || strpos($ret, 'SOAP-ERROR: Parsing WSDL') !== false
            ) {
                return new MT4_RunReturn(MT4_RunReturnType::FAILED_REPEATABLE, $ret);
            }
        } catch (\Exception $e) {
            if (
                strpos($e->getMessage(), 'Error Fetching http headers') !== false
                || strpos($e->getMessage(), 'Session expired') !== false
                || strpos($e->getMessage(), 'SOAP-ERROR: Parsing WSDL') !== false
            ) {
                return new MT4_RunReturn(MT4_RunReturnType::FAILED_REPEATABLE, $e->getMessage());
            }

            return new MT4_RunReturn(MT4_RunReturnType::FAILED, $e->getMessage());
        }

        return new MT4_RunReturn(MT4_RunReturnType::OK);
    }
}
