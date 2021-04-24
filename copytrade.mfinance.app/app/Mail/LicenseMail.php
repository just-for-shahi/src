<?php

namespace App\Mail;

use App\ManagerTemplateMailable;

class LicenseMail extends ManagerTemplateMailable
{
    public $userName;
    public $licenseKey;
    public $expiredAt;
    public $title;
    public $description;
    public $downloadUrl;

    public function __construct( $userName, $licenseKey, $expiredAt, $title, $description, $productKeys, $managerId, $tag=null)
    {
        $this->userName = $userName;
        $this->licenseKey = $licenseKey;
        $this->expiredAt = $expiredAt;
        $this->$title = $title;
        $this->$description = $description;

        $this->downloadUrl = url('/download/'.$managerId.'/'.implode(',',$productKeys));

        parent::__construct($managerId,$tag);
    }

    public function build()
    {
//        $address = config('licensing.email_from_address');
//        $name = config('licensing.email_from_name');

        //return $this->from($address, $name);
        return $this;
    }

}
