<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Grid\Tools\BatchAction;

class OrderCloseBatchAction extends BatchAction
{
    protected $account_number;

    public function __construct($accountNumber)
    {
        $this->account_number = $accountNumber;
    }

    public function script()
    {
        return <<<EOT

$('{$this->getElementClass()}').on('click', function() {

    $.ajax({
        method: 'POST',
        url: '{$this->resource}/close_order',
        data: {
            _token:'{$this->getToken()}',
            ids: $.admin.grid.selected(),
            acc: {$this->account_number}
        },
        success: function () {
            $.pjax.reload('#pjax-container');
            toastr.success('Close signal successfully sent');
        }
    });
});

EOT;
    }
}
