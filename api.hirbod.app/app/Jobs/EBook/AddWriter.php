<?php

namespace App\Jobs\EBook;

use App\Http\Controllers\EBook\Writer;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class AddWriter implements ShouldQueue
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
            $result=Writer::whereName($this->name)->first();
            if($result===null){
                $writer = Writer::create([
                    'uuid' => Str::uuid(),
                    'name' => $this->name
                ]);
            }else{
                $writer=Writer::whereName($this->name)->firstOrFail();
            }
            $this->model->writers()->sync($writer, false);
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
        }
    }
}
