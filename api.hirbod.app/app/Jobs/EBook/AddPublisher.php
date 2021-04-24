<?php

namespace App\Jobs\EBook;

use App\Http\Controllers\EBook\Publisher;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class AddPublisher implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $model, $name;

    /**
     * Create a new job instance.
     *
     * @param Model $model
     * @param string $name
     */
    public function __construct(Model $model, string $name)
    {
        $this->model = $model;
        $this->name = $name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            $result=Publisher::whereName($this->name)->first();
            if($result===null){
                $publisher = Publisher::create([
                    'uuid' => Str::uuid(),
                    'name' => $this->name
                ]);
            }else{
                $publisher=Publisher::whereName($this->name)->firstOrFail();
            }
           return $this->model->publishers()->syncWithoutDetaching($publisher);
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
        }
    }
}
