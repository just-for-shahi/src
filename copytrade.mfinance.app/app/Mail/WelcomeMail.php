<?php

namespace App\Mail;

use App\ManagerTemplateMailable;

class WelcomeMail extends ManagerTemplateMailable
{
    public $email;
    public $name;
    public $password;
    public $url;

    public function __construct($email, $name, $password, $url, $managerId = null)
    {
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
        $this->url = $url;

        parent::__construct($managerId);
    }

}
