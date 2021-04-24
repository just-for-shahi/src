<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ShouldQueueBase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $signature = 'job';

    public function error($message, $context = array())
    {
        Log::error('job. '.$this->signature . '. ' . $message, $context);
    }

    public function info($message, $context = array())
    {
        Log::info('job. '.$this->signature . '. ' . $message, $context);
    }

    public function critical($message, $context = array())
    {
        Log::critical('job. '.$this->signature . '. ' . $message, $context);
    }

    public function alert($message, $context = array())
    {
        Log::alert('job. '.$this->signature . '. ' . $message, $context);
    }
}