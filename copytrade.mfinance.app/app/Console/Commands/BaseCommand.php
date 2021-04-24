<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class BaseCommand extends Command
{

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function error($message, $context = array())
    {
        Log::error('console. ' . $this->signature . '. ' . $message, $context);
    }

    public function warning($message, $context = array())
    {
        Log::warning('console. ' . $this->signature . '. ' . $message, $context);
    }

    public function info($message, $context = array())
    {
        Log::info('console. ' . $this->signature . '. ' . $message, $context);
    }

    public function critical($message, $context = array())
    {
        Log::critical('console. ' . $this->signature . '. ' . $message, $context);
    }

    public function alert($message, $context = array())
    {
        Log::alert('console. ' . $this->signature . '. ' . $message, $context);
    }

    public function emergency($message, $context = array())
    {
        Log::emergency('console. ' . $this->signature . '. ' . $message, $context);
    }
}
