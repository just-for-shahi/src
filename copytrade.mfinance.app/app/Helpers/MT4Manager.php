<?php

namespace App\Helpers;

class MT4Manager {

    private $client;
    private $apiToken;

    public function init(string $host, int $timeout, string $managerServer, int $managerLogin, string $managerPassword ) {
        $this->client = new Client([
            'base_uri' => $host,
            'timeout' => $timeout,
            'verify' => false,
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);

        $this->_initApi($managerServer, $managerLogin, $managerPassword);
    }

    private function _initApi(string $server, int $login, string $password) {

        $res = $this->client->request('GET', 'init', ['query' => [
            'server'   => $server,
            'login'    => $login,
            'password' => $password
        ]]);

        $code = $res->getStatusCode();

        if($code == 200) {
            $json = $res->getBody();

            $data = json_decode($json);

            $this->apiToken = $data->token;
        }
    }

    public function getAccount($accountNumber) {
        try {
            $res = $this->client->get('user/'.$accountNumber.'?token='.$this->apiToken);

            $code = $res->getStatusCode();

            if($code == 200) {

                $json = $res->getBody();
                return json_decode($json);
            }
        } catch (RequestException $e) {
            $code = 503;

            if ($e->hasResponse()) {
                $res = $e->getResponse();
                $code = $res->getStatusCode();
            }
        }

    }


}
