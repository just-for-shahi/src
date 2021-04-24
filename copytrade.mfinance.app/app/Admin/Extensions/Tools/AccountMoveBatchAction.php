<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Grid\Tools\BatchAction;

class AccountMoveBatchAction extends BatchAction
{
    protected $ip;

    public function __construct($ip)
    {
        $this->ip = $ip;
    }

    public function script()
    {
        return <<<EOT

$('{$this->getElementClass()}').on('click', function() {

    $.ajax({
        method: 'POST',
        url: '{$this->resource}/move_to',
        data: {
            _token:'{$this->getToken()}',
            ids: $.admin.grid.selected(),
            ip: '{$this->ip}'
        },
        success: function () {
            $.pjax.reload('#pjax-container');
            toastr.success('Updated');
        }
    });
});

EOT;
    }
}
