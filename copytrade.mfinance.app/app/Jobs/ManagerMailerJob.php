<?php

namespace App\Jobs;

use App\Jobs\ShouldQueueBase;

class ManagerMailerJob extends ShouldQueueBase
{
  public $managerId;
  public $to;
  public $mailable;

  /*
  $configuration = [
 'smtp_host'    => 'SMTP-HOST-HERE',
 'smtp_port'    => 'SMTP-PORT-HERE',
 'smtp_username'  => 'SMTP-USERNAME-HERE',
 'smtp_password'  => 'SMTP-PASSWORD-HERE',
 'smtp_encryption'  => 'SMTP-ENCRYPTION-HERE',

 'from_email'    => 'FROM-EMAIL-HERE',
 'from_name'    => 'FROM-NAME-HERE',
];

ManagerMailer::dispatch($configuration, 'recipient', new SomeMailable());
*/

  public function __construct(int $managerId, string $to, Mailable $mailable)
  {
    $this->$managerId = $managerId;
    $this->to = $to;
    $this->mailable = $mailable;
  }

  public function handle()
  {
    $setting = ManagerMailSetting::find($this->$managerId);

    if($setting) {
        $mailer = app()->makeWith('custom.mailer', $setting->toArray());
        $mailer->to($this->to)->send($this->mailable);
    }
     else {
        \Mail::to($this->to)->send($this->mailable);
     }
  }
}