<?php

namespace App\Mail;

use App\ManagerTemplateMailable;

class AccountRestartedMail extends ManagerTemplateMailable
{
    public $accountNumber;
    public $brokerServer;

    public function __construct( $accountNumber, $brokerServer, $managerId)
    {
        $this->accountNumber = $accountNumber;
        $this->brokerServer = $brokerServer;

        parent::__construct($managerId);
    }

}
