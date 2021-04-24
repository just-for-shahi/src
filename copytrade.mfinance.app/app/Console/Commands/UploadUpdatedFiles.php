<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\File;
use App\Models\ApiServer;
use App\Helpers\ApiServerHelper;
use App\Console\Commands\BaseCommand;

class UploadUpdatedFiles extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'files:upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload files to api server';

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
            $apiServers = ApiServer::enabled()->get();

            foreach ($apiServers as $apiServer) {
                $files = File::where('is_updated_or_new', 1)->whereManagerId($apiServer->manager_id)->get();

                foreach ($files as $file) {
                    $name = $file->name;
                    $data = $file->data;
                    $type = $file->type;

                    try {
                        //echo $type.' - ' .$name .' - '. $apiServer->ip."\r\n";
                        $this->info('Uploading updated files', [
                            'type' => $type,
                            'name' => $name, 'ip' => $apiServer->ip
                        ]);
                        ApiServerHelper::upload($type, $name, $data, $apiServer->ip);

                        $file->is_updated_or_new = 0;
                        $file->save();
                    } catch (\Exception $e) {
                        //echo $e->getMessage();
                        $this->error('Failed to upload file', [
                            'name' => $name,
                            'type' => $type, 'ip' => $apiServer->ip
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            //echo $e->getMessage();
            $this->critical($e->getMessage());
        }
    }
}
