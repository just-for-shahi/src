<?php

namespace App\Mail;

use App\ManagerTemplateMailable;

class AccountInvalidMail extends ManagerTemplateMailable
{
    public $accountNumber;
    public $brokerServer;
    public $url;

    public function __construct($accountNumber, $brokerServer, $managerId = null)
    {
        $this->accountNumber = $accountNumber;
        $this->brokerServer = $brokerServer;
        $this->url = admin_url('/myaccounts');

        parent::__construct($managerId);
    }

}
