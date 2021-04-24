<?php

namespace App\Helpers;

use SoapClient;

class MT4Client
{
  protected $soap;

  public function init($endpoint)
  {
    $url_wsdl = 'http://' . $endpoint . ':7789/nj4x/ts?wsdl';
    //echo 'urk:'.$url_wsdl;
    $this->soap = new SoapClient($url_wsdl, array('location' => $url_wsdl, 'cache_wsdl' => WSDL_CACHE_NONE));
    //print_r($soap);
    //$soap = new soapclient($url_wsdl, array('cache_wsdl' => WSDL_CACHE_NONE));
  }

  public function stop($srv, $account_number, $password)
  {
    $token = $this->start_session($account_number);

    if ($token === false) {
      return false;
    }

    $array = array(
      'token' => $token,
      'mt4Account' => array(
        'srv' => $srv,
        'user' => $account_number,
        'password' => $password
      ),
      'nj4xEAParams' => array(
        'historyPeriod' => '10000',
        'period' => '1',
        'strategy' => 'jfx',
        'jfxHost' => '',
        'jfxPort' => 7788,
        'asynchOrdersOperations' => 'false'
      )
    );

    $ret = $this->soap->killMT4Terminal($array)->return;

    $this->soap->close($array);

    return $ret;
  }

  public function info()
  {
    $token = $this->start_session('info');

    if ($token === false) {
      return false;
    }



    $array = array(
      'token' => $token
    );

    $ret = $ret = $this->soap->getTSInfo($array);

    $this->soap->close($array);

    return $ret->return;
  }

  public function run($srv, $account_number, $password, $config)
  {
    $token = $this->start_session($account_number);

    if ($token === false) {
      return false;
    }

    $set = str_replace('.', '_', $srv);

    $array = array(
      'token' => $token,
      'mt4Account' => array(
        'proxyServer' => '0' . PHP_EOL . 'MarketWatch=../../sets/' . $set . '.sym.txt' . PHP_EOL . 'ProxyEnable=false' . PHP_EOL,
        'proxyType' => 0,
        'srv' => $srv,
        'user' => $account_number,
        'password' => $password
      ),
      'nj4xEAParams' => array(
        'historyPeriod' => '10000',
        'period' => '1',
        'strategy' => $config,
        'jfxHost' => '',
        'jfxPort' => 7788,
        'asynchOrdersOperations' => 'false'
      ),
      'restartTerminalIfRunning' => 'true'
    );

    $ret = $this->soap->runMT4Terminal($array);

    if (isset($ret->return))
      $ret = $ret->return;

    $this->soap->close($array);

    return $ret;
  }

  public function check($srv, $account_number, $password)
  {
    $token = $this->start_session($account_number);

    if ($token === false) {
      return false;
    }

    $array = array(
      'token' => $token,
      'mt4Account' => array(
        'srv' => $srv,
        'user' => $account_number,
        'password' => $password
      ),
      'nj4xEAParams' => array(
        'historyPeriod' => '10000',
        'period' => '1',
        'strategy' => 'jfx',
        'jfxHost' => '',
        'jfxPort' => 7788,
        'asynchOrdersOperations' => 'false'
      )
    );

    $ret = $this->soap->checkMT4Terminal($array)->return;

    $this->soap->close($array);

    return $ret;
  }


  private function start_session($account_number)
  {
    if (!$this->soap) {
      return false;
    }

    $array = array(
      'clientInfo' => array(
        'clientName' => 'fxs-' . $account_number,
        'apiVersion' => '2.6.6'
      )
    );

    return $this->soap->startSession($array)->return;
  }
}
