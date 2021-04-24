<?php


namespace App\Http\Controllers\EBook;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mpdf\Mpdf;
use Mpdf\MpdfException;
use setasign\Fpdi\PdfParser\PdfParserException;

class EBookController extends Controller
{
    private $entity;

    public function __construct()
    {

        $this->entity = new EBook();
    }

    public function index(){
        return view('ebook.list', ['ebooks' => EBook::me()->latest()->paginate(15)]);
    }

    public function create(){
        return view('ebook.create', ['categories' => Category::where('type', 1)->get()]);
    }

    public function store(Request $request){
        $token = Str::random(255);
        $sampleToken = Str::random(16);
        $pathURI = date('Y-m').'/ebooks/';
        $path = Storage::disk('public')->put($pathURI, $request->file('pdf'));
        $samplePath = Storage::disk('public')->put($pathURI.'/sample/', $request->file('pdf'));
        $pdf = new Mpdf(['mode' => 'utf-8', 'tempDir' => public_path(date('Y-m'))]);
        $sample = new Mpdf(['mode' => 'utf-8', 'tempDir' => public_path(date('Y-m'))]);
        try {
            $pdfSource = $pdf->setSourceFile(public_path($path));
            $sample->setSourceFile(public_path($samplePath));
            $pages = $pdfSource;
            $samplePages = $pages > 30 ? $pages/5 : $pages / 2;
            for ($s=1;$s<=($samplePages);$s++){
                $sample->AddPage();
                $sample->SetDisplayMode('fullpage', 'single');
                $importSample = $sample->ImportPage($s);
                $sample->SetWatermarkImage('https://hirbodapp.ir/wp-content/uploads/2019/06/logo.png', 0.05, 'F', 'F');
                $sample->showWatermarkImage = true;
                $sizeSample = $sample->getTemplateSize($importSample);
                $sample->useTemplate($importSample, 0, 0, $sizeSample['width'], $sizeSample['height'], true);
            }
            for ($i=1; $i<=($pdfSource); $i++) {
                $pdf->AddPage();
                $pdf->SetDisplayMode('fullpage', 'single');
                $importPage = $pdf->ImportPage($i);
                $pdf->SetWatermarkImage('https://hirbodapp.ir/wp-content/uploads/2019/06/logo.png', 0.05, 'F', 'F');
                $pdf->showWatermarkImage = true;
                $size = $pdf->getTemplateSize($importPage);
                $pdf->useTemplate($importPage, 0, 0, $size['width'], $size['height'], true);
            }
        } catch (PdfParserException $e) {
            Bugsnag::notifyException($e);
           return Tag::error($e);
        }
        $pdf->SetProtection(array(), $token, 'milad'.$token, 128);
        $sample->SetProtection(array(), $sampleToken, 'milad'.$sampleToken, 128);
        try {
            $pdf->Output(public_path($path));
            $sample->Output(public_path($samplePath));
        } catch (MpdfException $e) {
            Bugsnag::notifyException($e);
            return abort(500);
        }
//
        Storage::disk(config('filesystems.default'))->put($path, Storage::disk('public')->get($path));
        Storage::disk(config('filesystems.default'))->put($samplePath, Storage::disk('public')->get($samplePath));
        $this->entity = EBook::create([
            'code' => Str::random(6),
            'user' => auth()->id(),
            'title' => $request->input('title'),
            'cover' => Storage::disk('liara')->put(date('Y-m').'/ebooks/cover/', $request->file('cover')),
            'introduction' => $request->input('introduction'),
//            'pages' => $pages,
            'isbn' => $request->input('isbn'),
            'level' => $request->input('level'),
            'token' => $token,
            'sample_token' => $sampleToken,
//            'file' => $path,
//            'sample' => $samplePath
        ]);
//        $this->dispatch(new ProcessPdf($this->entity->id, $path));
        $publisher = Publisher::updateOrCreate([
            'name' => $request->input('publisher')
        ]);
        $this->entity->publishers()->sync($publisher, false);
        $writer = Writer::updateOrCreate([
            'name' => $request->input('writer'),
        ]);
        $this->entity->writers()->sync($writer, false);
        $this->entity->categories()->sync($request->input('category'), false);
        $tags = explode('-', $request->input('tags'));
        foreach ($tags as $tag){
            $tag = Tag::updateOrCreate([
                'name' => rtrim(ltrim($tag))
            ]);
            $this->entity->tags()->sync($tag->id, false);
        }
        return redirect()->route('ebooks.index');
    }

}