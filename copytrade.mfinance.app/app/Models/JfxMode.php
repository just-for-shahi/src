<?php

namespace App\Models;

class JfxMode
{
    const SYNC_DISABLED = 0;
    const DEBUG_ENABLED = 1;
    const CALC_STAT = 2;
    const MYSQL_SKIP_OWN = 4;
    const MYSQL_WATCHER = 8;
    const CLOSE_WHEN = 16;
    const LOAD_EAS = 32;
    const WEBHOOK_ENABLED = 64;
    const RUN_EXES = 128;
    const COPIER_DISABLED = 256;
    const HAS_ADV_FILTER = 512;

    public static function title($mode)
    {
        return $mode;
    }
}
