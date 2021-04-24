<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Grid\Tools\BatchAction;

class AccountStatusBatchAction extends BatchAction
{
    protected $account_status;

    public function __construct($account_status)
    {
        $this->account_status = $account_status;
    }

    public function script()
    {
        return <<<EOT

$('{$this->getElementClass()}').on('click', function() {

    $.ajax({
        method: 'POST',
        url: '{$this->resource}/update_status',
        data: {
            _token:'{$this->getToken()}',
            ids: $.admin.grid.selected(),
            status: {$this->account_status}
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
