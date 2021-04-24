<?php

namespace App\Admin\Extensions\Tools;

use App\Models\AccountStatus;
use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;

class ApiServerGridExt extends AbstractTool
{

    private $api_server_ips;
    private $api_server_ip_active;

    public function __construct($api_server_ip_active, $api_server_ips)
    {
        $this->api_server_ip_active = $api_server_ip_active;
        $this->api_server_ips = $api_server_ips;
    }

    public function script()
    {
        $url = Request::fullUrlWithQuery(['api_server_ip' => '_api_server_ip_']);

        return <<<EOT

        $('.grid-api-server-ip').on('click', function() {
            var url = "$url".replace('_api_server_ip_', $(this).attr('data-ip'));

            $.pjax({container:'#pjax-container', url: url });
        });
EOT;
    }

    public function render()
    {
        Admin::script($this->script());

        return view('admin.tools.api_servers')
        ->with('api_server_ips', $this->api_server_ips)
        ->with('api_server_ip_active', $this->api_server_ip_active);
    }
}
