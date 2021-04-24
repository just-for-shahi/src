<?php

namespace App\Console\Commands;

use App\Models\File;
use App\Models\BrokerServer;
use App\Console\Commands\BaseCommand;
use Illuminate\Support\Facades\Storage;

class UploadUpdatedBrokerServers extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'brokerservers:upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload broker servers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $brokerServers = BrokerServer::api()->where('is_updated_or_new', 1)->take(30)->get();
            foreach ($brokerServers as $brokerServer) {
                $name = $brokerServer->name;
                $srvFile = $brokerServer->srv_file;

                try {

                    $this->info('Uploading srv file to gdrive', ['name' => $name]);
                    Storage::disk('google')->put($name . '.srv', $srvFile);

                    if ($brokerServer->pairs_file_id) {
                        try {
                            $pairFile = File::find($brokerServer->pairs_file_id);

                            $this->info('Uploading pair file to gdrive', ['name' => $pairFile->name]);
                            Storage::disk('google')->put($pairFile->name, $pairFile->data);
                        } catch (\Exception $e) {
                            $this->error('Failed to upload pair file to gdrive', ['name' => $pairFile->name]);
                        }
                    }

                    $brokerServer->is_updated_or_new = 0;
                    $brokerServer->save();
                } catch (\Exception $e) {
                    $this->error('Failed to upload srv file to gdrive', ['name' => $name]);
                }
            }
        } catch (\Exception $e) {
            $this->critical($e->getMessage());
            //echo $e->getMessage();
        }
    }
}
