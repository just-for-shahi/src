<?php

namespace App\Mail;

use App\ManagerTemplateMailable;

class LicenseCancelMail extends ManagerTemplateMailable
{
    public $userName;

    public function __construct( $userName, $managerId, $tag=null)
    {
        $this->userName = $userName;

        parent::__construct($managerId,$tag);
    }

    public function build()
    {
        return $this;
    }

}
