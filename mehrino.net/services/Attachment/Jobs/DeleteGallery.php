<?php


namespace Services\Attachment\Jobs;


use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Services\Attachment\Models\Attachment;

class DeleteGallery implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 5;
    protected $image;
    public $maxExceptions = 3;
    public $timeout = 120;
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
            $find = Attachment::where('attachable_type', User::class)->find($this->image->id);
            // if($find):
                deleteAll($this->image->path);
            // endif;
        } catch (\Exception $e) {
            $this->release(10);
            echo $e->getMessage() . "\n";
            Bugsnag::notifyException($e);
        }
    }
}
