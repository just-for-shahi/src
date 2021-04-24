<?php


namespace Services\Attachment\Jobs;


use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImageThumbnail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 5;
    protected $image;
    public $maxExceptions = 3;
    public $timeout = 180;
    /**
     * Create a new job instance.
     *
     * @param $image
     */
    public function __construct($image)
    {
        $this->image = $image;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            upload($this->image);
        } catch (\Exception $e) {
            $this->release(10);
            echo $e->getMessage() . "\n";
            Bugsnag::notifyException($e);
        }
    }
}
