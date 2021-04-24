<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Displayers\AbstractDisplayer;

class Checkboxe extends AbstractDisplayer
{
    public function display()
    {
        $name = $this->column->getName();
        $checked = (bool) $this->value ? 'checked' : '';

        Admin::script($this->script());

        return <<<EOT
            <input type="checkbox" class="grid-row-checkbox checkboxe-{$name}" data-key="{$this->getKey()}" name="grid-checkbox-{$name}[]" {$checked} />
EOT;
    }

    protected function script()
    {
        $name = $this->column->getName();

        return <<<EOT
    $('.grid-row-checkbox').iCheck({checkboxClass:'icheckbox_minimal-blue'}).on('ifChanged', function () {
        if (this.checked) {
            $(this).closest('tr').css('background-color', '#ffffd5');
        } else {
            $(this).closest('tr').css('background-color', '');
        }
        
        var key = $(this).data('key');
        $.ajax({
            url: "{$this->getResource()}/" + key,
            type: "POST",
            data: {
                {$name}: this.checked ? 1 : 0,
                _token: LA.token,
                _method: 'PUT'
            },
            success: function (data) {
                toastr.success(data.message);
            }
        });

        return false;    
    });        
EOT;
    }
}
