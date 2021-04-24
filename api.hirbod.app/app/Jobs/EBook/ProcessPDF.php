<?php

namespace App\Jobs\EBook;

use App\Events\Pdf;
use App\Http\Controllers\Account\User;
use App\Http\Controllers\EBook\EBook;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use Mpdf\MpdfException;
use setasign\Fpdi\PdfParser\PdfParserException;

class ProcessPDF implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $model;
    protected $file;
    protected $sample;
    protected $f;

    /**
     * Create a new job instance.
     *
     * @param Model $model
     * @param $file
     * @param $sample
     * @param $f
     */
    public function __construct(Model $model,$file,$sample,$f)
    {
        $this->model = $model;
        $this->file = $file;
        $this->sample = $sample;
        $this->f = $f;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {

            return dd("asd");

            event(new Pdf(storage_path($this->file)));

            $filePath = storage_path($this->file);
            $samplePath = storage_path($this->sample);
             $token = $this->model['token'];
            $sampleToken = $this->model['sample_token'];
            $pdf = new Mpdf(['mode' => 'utf-8', 'tempDir' => storage_path('tmp')]);
            $sample = new Mpdf(['mode' => 'utf-8', 'tempDir' => storage_path('tmp')]);
            try {
                $pdfSource = $pdf->setSourceFile($filePath);
                $sample->setSourceFile($samplePath);
                $pages = $pdfSource;
                $samplePages = $pages > 30 ? $pages/5 : $pages / 2;
                for ($s=1;$s<=($samplePages);$s++){
                    $sample->AddPage();
                    $sample->SetDisplayMode('fullpage', 'single');
                    $importSample = $sample->ImportPage($s);
                    $sample->SetWatermarkImage(public_path('logo.png'), 0.05, 'F', 'F');
                    $sample->showWatermarkImage = true;
                    $sizeSample = $sample->getTemplateSize($importSample);
                    $sample->useTemplate($importSample, 0, 0, $sizeSample['width'], $sizeSample['height'], true);
                }


                for ($i=1; $i<=($pdfSource); $i++) {
                    $pdf->AddPage();
                    $pdf->SetDisplayMode('fullpage', 'single');
                    $importPage = $pdf->ImportPage($i);
                    $pdf->SetWatermarkImage(public_path('logo.png'), 0.05, 'F', 'F');
                    $pdf->showWatermarkImage = true;
                    $size = $pdf->getTemplateSize($importPage);
                    $pdf->useTemplate($importPage, 0, 0, $size['width'], $size['height'], true);
                }
            } catch (PdfParserException $e) {
                return dd($e->getMessage());
//                Bugsnag::notifyException($e);
            }
            $pdf->SetProtection(array(), $token, 'milad'.$token, 128);
            $sample->SetProtection(array(), $sampleToken, 'milad'.$sampleToken, 128);
            try {
                $pdf->Output($filePath);
                $sample->Output($sample);
            } catch (MpdfException $e) {
                Bugsnag::notifyException($e);
            }

//            $file= Storage::put('ebooks'.User::whereMobile('9195995044')->firstOrFail()->uuid.'/file', $filePath);
//            $file = Storage::disk('arvan')->putFile(date('Y-m').'/ebooks/', new File($filePath));
            $file_direction  =getHashName($file);
//            $sample= Storage::put('ebooks'.User::whereMobile('9195995044')->firstOrFail()->uuid.'/sample', $samplePath);
//            $sample = Storage::disk('arvan')->putFile(date('Y-m').'/ebooks/', new File($samplePath));

            $sample_direction  =getHashName($sample);
            Storage::disk('public')->delete($filePath);
            Storage::disk('public')->delete($samplePath);
            EBook::where('id', $this->model['id'])->update([
                'file' => $file_direction,
                'sample' => $sample_direction
            ]);
        }catch (\Exception $e){
            return $e->getMessage();
//            Bugsnag::notifyException($e);
        }
    }
}
