<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Grid;
use Encore\Admin\Admin;

class AddToCopierSubscriptionAction
{
    public $id;
    public $title;
    protected $resource;

    public function __construct($id, $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    public function setResource($resource)
    {
        $this->resource = $resource;
    }

    public function getToken()
    {
        return csrf_token();
    }

    public function script()
    {
        return <<<EOT
        
$('.grid-add2copier_subscription-{$this->id}').on('click', function() {

    $.ajax({        
        method: 'POST',
        url: '{$this->resource}/add2copier_subscription',
        data: {
            _token:'{$this->getToken()}',
            ids: $.admin.grid.selected(),
            subscription: {$this->id}
        },
        success: function () {
            $.pjax.reload('#pjax-container');
            toastr.success('Added To {$this->title}');
        }
    });
});

EOT;
    }
}
