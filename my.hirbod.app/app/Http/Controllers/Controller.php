<?php

namespace App\Http\Controllers;

use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Log\Logger;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use FFMpeg\Filters\Video\VideoFilters;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function tmpw($id){
        try{
            ini_set('max_execution_time', 180); //3 minutes
            $data = file_get_contents("https://www.youtube.com/get_video_info?video_id=$id");
            return dd(parse_str($data));
            $arr = explode("," , $url_encoded_fmt_stream_map);
            parse_str($arr[0]);
            copy($url, "input.mp4");
            $concatenate = "file 'output0.mp4'
            file 'output-$id.mp4'
            file 'output2.mp4'";
            Storage::disk('public')->put('input.txt', $concatenate);
                //$processConvertInput0 = new Process('C:\ffmpeg\bin\ffmpeg -i input0.mp4 -s 1280x720 -vcodec libx264 output0.mp4');
                //$processConvertInput0->run();
                $processConvertVideo = new Process('C:\ffmpeg\bin\ffmpeg -i input.mp4 -s 1280x720 -vcodec libx264 output-'.$id.'.mp4', '300');
                $processConvertVideo->run();
                //$processConvertInput1 = new Process('C:\ffmpeg\bin\ffmpeg -i input1.mp4 -s 1280x720 -vcodec libx264 output2.mp4');
                //$processConvertInput1->run();
                $processWatermark = new Process('C:\ffmpeg\bin\ffmpeg -i output-'.$id.'.mp4 -i logo.png -filter_complex "overlay=main_w-overlay_w-10:10" finalWatermarked-'.$id.'.mp4');
                $processWatermark->run();
                if ($processWatermark->isSuccessful()){
                    $processConcatenate = new Process('C:\ffmpeg\bin\ffmpeg -f concat -i input.txt -codec copy '.$id.'.mp4');
                    $processConcatenate->run();
                    if ($processConcatenate->isSuccessful()){
                        $process = new Process('cd C:\Users\Administrator\Desktop\youtube\public');
                        $process->run();
                        if ($process->isSuccessful()){
                            $process = new Process('winscp.com /command "open ftp://windows_usa_laravel_winscp@d1.menareh.net:?@l^!Hq@WKs)@94.23.12.22" "put C:\Users\Administrator\Desktop\youtube\public\"'.$id.'".mp4 /" "exit"');
                            $process->run();
                            if ($process->isSuccessful()){
                                return view('success');
                            }else{
                                throw new ProcessFailedException($process);
                            }
                        }else{
                            throw new ProcessFailedException($process);
                        }

                    }else{
                        throw new ProcessFailedException($processConcatenate);
                    }

                }else{
                    throw new ProcessFailedException($processWatermark);
                }
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

    public function tmp(){
        try{
            ini_set('max_execution_time', 600); //3 minutes
            set_time_limit(600);
            $FFMpegCreate = [

            ];
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                $FFMpegCreate = [
                    'ffmpeg.binaries'  => app_path('bin\windows\ffmpeg.exe'),
                    'ffprobe.binaries' => app_path('bin\windows\ffprobe.exe'),
                    'timeout'          => 3600, // The timeout for the underlying process
                    'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
                ];
            }
            $path = public_path('input.mp4');
            $ffmpeg = FFMpeg::create($FFMpegCreate, \logger());
            $video = $ffmpeg->open($path);
            $video->filters()
                ->watermark('logo.png', [
                    'position' => 'relative',
                    'bottom' => 50,
                    'right' => 50,
                ])
                ->synchronize();
//                ->resize(new FFMpeg\Coordinate\Dimension(320, 240))
//                ->synchronize();
//            $video
//                ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(10))
//                ->save('frame.jpg');
            $format = new X264('aac','libx264');
            $video->save($format, public_path('output.mp4'));
            return dd('sucess');
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

    public function tmp3(){
        try{
            $path = app_path('bin\windows\ffmpeg');
            $processConvertVideo = new Process([$path. ' -i '.public_path('mantra.mp4').' -s 1280x720 -vcodec libx264 '.public_path('output.mp4')]);
            $processConvertVideo->run();
            if ($processConvertVideo->isSuccessful()){
                return dd($processConvertVideo->getOutput());
            }
            else{
                throw new ProcessFailedException($processConvertVideo);
            }
            //$processConvertInput1 = new Process('C:\ffmpeg\bin\ffmpeg -i input1.mp4 -s 1280x720 -vcodec libx264 output2.mp4');
            //$processConvertInput1->run();
            $processWatermark = new Process('C:\ffmpeg\bin\ffmpeg -i output-'.$id.'.mp4 -i logo.png -filter_complex "overlay=main_w-overlay_w-10:10" finalWatermarked-'.$id.'.mp4');
            $processWatermark->run();
            if ($processWatermark->isSuccessful()){
                $processConcatenate = new Process('C:\ffmpeg\bin\ffmpeg -f concat -i input.txt -codec copy '.$id.'.mp4');
                $processConcatenate->run();
                if ($processConcatenate->isSuccessful()){
                    $process = new Process('cd C:\Users\Administrator\Desktop\youtube\public');
                    $process->run();
                    if ($process->isSuccessful()){
                        $process = new Process('winscp.com /command "open ftp://windows_usa_laravel_winscp@d1.menareh.net:?@l^!Hq@WKs)@94.23.12.22" "put C:\Users\Administrator\Desktop\youtube\public\"'.$id.'".mp4 /" "exit"');
                        $process->run();
                        if ($process->isSuccessful()){
                            return view('success');
                        }else{
                            throw new ProcessFailedException($process);
                        }
                    }else{
                        throw new ProcessFailedException($process);
                    }

                }else{
                    throw new ProcessFailedException($processConcatenate);
                }

            }else{
                throw new ProcessFailedException($processWatermark);
            }

        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

    public function tmp4(){
        try{
            FFMpeg::open('input.mp4')
                ->export()
                ->toDisk('local')
                ->inFormat(new \FFMpeg\Format\Video\X264)
                ->addFilter(function (VideoFilters $filters) {
                    $filters->resize(new \FFMpeg\Coordinate\Dimension(640, 480));
                    $filters->watermark(public_path('assets/images/logo.png'), [
                        'position' => 'relative',
                        'bottom' => 50,
                        'right' => 50,
                    ]);
                })
                ->save('output.mkv');
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }
}
