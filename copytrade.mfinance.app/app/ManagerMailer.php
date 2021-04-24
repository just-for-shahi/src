<?php

namespace App;

use App\ManagerTemplateMailable;
use App\Models\ManagerMailSetting;

class ManagerMailer
{
  public static function handle(string $to, ManagerTemplateMailable $mailable)
  {
    $setting = ManagerMailSetting::find($mailable->getManagerId());

    if($setting) {
        if(!empty($setting->main_template))
            $mailable->setLayout($setting->main_template);
        $mailer = app()->makeWith('custom.mailer', $setting->toArray());
        $mailer->to($to)->send($mailable);
    }
     else {
        \Mail::to($to)->send($mailable);
     }
  }
}