<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Grid\Tools\AbstractTool;

class AddExpertAccountButton extends AbstractTool
{
    public $expertId;

    public function __construct($expertId)
    {
        $this->expertId = $expertId;
    }

    public function render()
    {
        $new = 'New';

        return <<<EOT

<div class="btn-group pull-right grid-create-btn" style="margin-right: 10px">
    <a href="{$this->grid->resource()}/create?&expert_id={$this->expertId}" class="btn btn-sm btn-success">
        <i class="fa fa-plus"></i>&nbsp;&nbsp;{$new}
    </a>
</div>

EOT;
    }
}
