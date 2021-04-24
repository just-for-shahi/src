<?php

namespace App\Models;

class CopierType
{
    const MASTER   = 1;
    const SLAVE    = 2;
    const STRATEGY = 3;


    public static function title($type)
    {
        switch ($type) {
      case CopierType::MASTER:
        return 'Sender';
      case CopierType::SLAVE:
        return 'Follower';
      case CopierType::STRATEGY:
        return 'Strategy';
      default:
        return $type;
    }
    }
}
