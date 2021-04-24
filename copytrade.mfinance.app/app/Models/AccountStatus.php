<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\ApiServer;
use App\Models\BrokerServer;

class AccountStatus
{
    const NONE = 0;
    const ONLINE = 1;
    const OFFLINE = 2;
    const PENDING = 3;
    const SUSPEND = 4;
    const REMOVING = 5;
    const INVALID = 6;
    const SUSPEND_STOPPED = 7;
    const INVALID_STOPPED = 8;
    const VERIFYING = 9;
    const RESETTING = 10;
    const CNN_LOST = 11;

    public static function title($status, $is_fake = false)
    {
        switch ($status) {
        case AccountStatus::SUSPEND_STOPPED:
        case AccountStatus::SUSPEND:
          return 'Suspended';
        case AccountStatus::NONE:
          if ($is_fake) {
              return 'Online.';
          }
          return 'Pinging';
        case AccountStatus::PENDING:
          if ($is_fake) {
              return 'Online.';
          }
          return 'Connecting';
        case AccountStatus::ONLINE:
          return 'Online';
        case AccountStatus::OFFLINE:
          return 'Offline';
        case AccountStatus::VERIFYING:
          if ($is_fake) {
              return 'Online..';
          }
          return 'Verifying';
        case AccountStatus::REMOVING:
          return 'Removing';
        case AccountStatus::INVALID:
        case AccountStatus::INVALID_STOPPED:
          return 'Invalid';
        case AccountStatus::RESETTING:
          return 'Resetting';

        default:
          return 'Connecting.';
      }
    }
}
