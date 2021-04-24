<?php

namespace App\Admin\Extensions\Tools;

use App\Models\AccountStatus;
use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;

class AccountStatusGridExt extends AbstractTool
{
    public function script()
    {
        $url = Request::fullUrlWithQuery(['account_status' => '_account_status_']);

        return <<<EOT

$('input:radio.account-status').change(function () {

    var url = "$url".replace('_account_status_', $(this).val());

    $.pjax({container:'#pjax-container', url: url });

});

EOT;
    }

    public function render()
    {
        Admin::script($this->script());

        $options = [
            'all'   => 'All',
            AccountStatus::ONLINE     => AccountStatus::title(AccountStatus::ONLINE),
            AccountStatus::OFFLINE    => AccountStatus::title(AccountStatus::OFFLINE),
            AccountStatus::INVALID    => AccountStatus::title(AccountStatus::INVALID),
            AccountStatus::PENDING    => AccountStatus::title(AccountStatus::PENDING),
        ];

        return view('admin.tools.account_status', compact('options'));
    }
}
