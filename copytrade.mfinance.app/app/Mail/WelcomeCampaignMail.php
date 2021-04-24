<?php

namespace App\Mail;

use App\ManagerTemplateMailable;

class WelcomeCampaignMail extends ManagerTemplateMailable
{
    public $data;
    public $userName;
    public $campaignTitle;
    public $campaignDescription;
    public $licenseKey;
    public $expiredAt;

    public function __construct( $userName, $campaignTitle, $campaignDescription, $licenseKey, $expiredAt, $managerId)
    {
        $this->userName = $userName;
        $this->campaignTitle = $campaignTitle;
        $this->campaignDescription = $campaignDescription;
        $this->licenseKey = $licenseKey;
        $this->expiredAt = $expiredAt;

        parent::__construct($managerId);
    }

}
