<?php


namespace App\Http\Controllers\EBook;


use App\Http\Requests\StoreEBookRequest;
use App\Http\Requests\UpdateEBookRequest;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mpdf\Mpdf;
use Mpdf\MpdfException;
use setasign\Fpdi\PdfParser\PdfParserException;

class Controller extends \App\Http\Controllers\Controller
{

    private $model;

    public function __construct()
    {
        $this->model = new EBook();
    }

    public function index(){
        try{

            $items = EBook::me()->with(['writers','publishers'])->latest()->paginate(15);
            return view('ebooks.index', compact('items'));
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

    public function create(){
        try{
            $cats = Category::where('type', 1)->get();
            return view('ebooks.create', compact('cats'));
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

    public function store(StoreEBookRequest $r){
        try{
            $watermarkLogo = 'https://hirbod.ac/assets/img/app-mobile-image.png';
            $token = Str::random(191);
            $sampleToken = Str::random(16);
            $pathURI = date('Y-m').'/ebooks';
//            $path = Storage::disk('public')->put($pathURI, $r->file('file'));
//            $samplePath = Storage::disk('public')->put($pathURI.'/sample/', $r->file('file'));
//            $pdf = new Mpdf(['mode' => 'utf-8', 'tempDir' => storage_path(date('Y-m'))]);
//            $sample = new Mpdf(['mode' => 'utf-8', 'tempDir' => storage_path(date('Y-m'))]);
//            try {
//                $pdfSource = $pdf->setSourceFile(storage_path($path));
//                $sample->setSourceFile(storage_path($samplePath));
//                $pages = $pdfSource;
//                $samplePages = $pages > 30 ? $pages/5 : $pages / 2;
//                for ($s=1;$s<=($samplePages);$s++){
//                    $sample->AddPage();
//                    $sample->SetDisplayMode('fullpage', 'single');
//                    $importSample = $sample->ImportPage($s);
//                    $sample->SetWatermarkImage($watermarkLogo, 0.05, 'F', 'F');
//                    $sample->showWatermarkImage = true;
//                    $sizeSample = $sample->getTemplateSize($importSample);
//                    $sample->useTemplate($importSample, 0, 0, $sizeSample['width'], $sizeSample['height'], true);
//                }
//                for ($i=1; $i<=($pdfSource); $i++) {
//                    $pdf->AddPage();
//                    $pdf->SetDisplayMode('fullpage', 'single');
//                    $importPage = $pdf->ImportPage($i);
//                    $pdf->SetWatermarkImage($watermarkLogo, 0.05, 'F', 'F');
//                    $pdf->showWatermarkImage = true;
//                    $size = $pdf->getTemplateSize($importPage);
//                    $pdf->useTemplate($importPage, 0, 0, $size['width'], $size['height'], true);
//                }
//            } catch (PdfParserException $e) {
//                return dd($e->getMessage());
//            }
//            $pdf->SetProtection(array(), $token, 'milad'.$token, 128);
//            $sample->SetProtection(array(), $sampleToken, 'milad'.$sampleToken, 128);
//            try {
//                $pdf->Output(storage_path($path));
//                $sample->Output(storage_path($samplePath));
//            } catch (MpdfException $e) {
//                return dd($e->getMessage());
//            }
//            $finalPath = Storage::putFile($path, storage_path($path));
//            $finalSamplePath = Storage::putFile($samplePath, storage_path($samplePath));
            $this->model = EBook::create([
                'user' => auth()->id(),
                'title' => $r->input('title'),
                'cover' => $r->file('cover')->store(date('Y-m').'/ebooks/cover'),
                'introduction' => $r->input('introduction'),
                'pages' => 0,
                'isbn' => $r->input('isbn'),
                'level' => $r->input('level'),
                'token' => 'milad'.random_int(1000,999999),
                'sample_token' => 'milad'.random_int(1000,999999), //@TODO: Run for all of milad of decryption
                'file' => $r->file('file')->store(date('Y-m').'/ebooks/'),
                'sample' => null
            ]);
//        $this->dispatch(new ProcessPdf($this->entity->id, $path));
            $publisher = Publisher::updateOrCreate([
                'name' => $r->input('publisher')
            ]);
            $this->model->publishers()->sync($publisher, false);
            $writer = Writer::updateOrCreate([
                'name' => $r->input('writer'),
            ]);
            $this->model->writers()->sync($writer, false);
            $this->model->categories()->sync($r->input('category'), false);
            $tags = explode('-', $r->input('tags'));
            foreach ($tags as $tag){
                $tag = Tag::updateOrCreate([
                    'name' => rtrim(ltrim($tag))
                ]);
                $this->model->tags()->sync($tag->id, false);
            }
            return redirect()->route('ebooks.index');

        }catch (\Exception $e){
            return dd(['eeeee', $e->getMessage()]);
        }
    }

    public function show($uuid){
        try{
            $ebook = EBook::where(['uuid' => $uuid, 'user' => auth()->id()])->first();
            if ($ebook === null){
                return abort(404);
            }
            return view('ebooks.show', compact('ebook'));
        }catch (\Exception $e){
            return dd($e);
        }
    }

    public function update($uuid, UpdateEBookRequest $r){
        try{
            $data = [
                'title' => $r->input('title'),
                'description' => $r->input('description'),
                'introduction' => $r->input('introduction'),
                'year' => $r->input('year'),
            ];
            if ($r->hasFile('cover')){
                $data['cover'] = $r->file('cover')->store(date('Y-m').'/ebooks');
            }
            EBook::where('uuid', $uuid)->update($data);
            return redirect()->route('ebooks.index');
        }catch (\Exception $e){
            return dd($e);
        }
    }

    public function destroy($ebook){
        try{
            $this->model->where(['uuid' => $ebook, 'user' => auth()->id()])->delete();
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
        return redirect()->route('ebooks.index');
    }

}
