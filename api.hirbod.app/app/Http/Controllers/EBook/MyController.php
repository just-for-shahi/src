<?php


namespace App\Http\Controllers\EBook;


use App\Facades\HHash\HHash;
use App\Facades\HResponse\HResponse;
use App\Facades\Rest\Rest;
use App\Http\Controllers\Account\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequest;
use App\Http\Requests\EbookRequest;
use App\Jobs\EBook\AddPublisher;
use App\Jobs\EBook\AddWriter;
use App\Jobs\EBook\ProcessPDF;
use App\Models\Category;
use App\Models\Tag;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mpdf\Mpdf;
use Mpdf\MpdfException;
use setasign\Fpdi\PdfParser\PdfParserException;

class MyController extends Controller
{

    private $obj;

    public function __construct()
    {
        $this->obj = new EBook();
    }

    public function index(Request $r){
        try{
            $msg='EBooks fetched.';
            $items = $this->obj->me()->latest()->with(['publishers', 'writers', 'tags', 'categories'])->paginate($r->input('count', 15), ['*'], $r->input('page', 1));
            $data = HResponse::ebooks($items);
//            foreach ($items as $item){
//                $data[] = [
//                    'uuid' => $item->uuid,
//                    'title' => $item->title,
//                    'cover' => Rest::$SARA.$item->cover,
//                    'description' => $item->description,
//                    'introduction' => $item->introduction,
//                    'readers' => $item->readers,
//                    'pages' => intval($item->pages),
//                    'sample' => Rest::$SARA.$item->sample,
//                    'file' => Rest::$SARA.$item->file,
//                    'isbn' => $item->isbn,
//                    'level' => $item->level,
//                    'status' => $item->status,
//                    'token' => $item->token,
//                    'sampleToken' => $item->sample_token,
//                    'publisher' => HResponse::publishers($item->publishers),
//                    'writers' => HResponse::writers($item->writers),
//                    'tags' => HResponse::tags($item->tags),
//                    'categories' => HResponse::categories($item->categories),
//                    'createdAt' => $item->jCreated,
//                    'updatedAt' => $item->jUpdated
//                ];
//            }
            return Rest::success($msg, $data);
        }catch (\Exception $e){
            return Rest::badRequest();
        }
    }


    public function show($uuid,Request $request){

        try {
            $ebook=EBook::me()->with('prices')->where('uuid',$uuid)->firstOrFail();
            $price = $ebook->relation ? $ebook->prices[0]->price : 0;
            $data=[
                "uuid"=>$ebook->uuid,
                "price"=>$price,
                "username"=> User::find($ebook->user)->username,
                "title"=> $ebook->title,
                "year"=> $ebook->year,
                "cover"=> $ebook->cover === null ? null :  Storage::temporaryUrl(
                    'my/ebooks/'.auth('api')->user()->uuid.'/cover/'.$ebook->cover,
                    now()->addMinutes( config('hirbod.temporary.ebooks.owner'))
                ),
                "description"=> $ebook->description,
                "introduction"=> $ebook->introduction,
                "readers"=> intval($ebook->readers),
                "pages"=>intval( $ebook->pages),
                "sample"=> $ebook->sample === null ? null :  Storage::temporaryUrl(
                    $ebook->sample,
                    now()->addMinutes( config('hirbod.temporary.ebooks.owner'))
                ),
                "file"=> $ebook->file === null ? null :  Storage::temporaryUrl(
                    $ebook->file,
                    now()->addMinutes( config('hirbod.temporary.ebooks.owner'))
                ),
                "isbn"=> $ebook->isbn,
                "level"=>$ebook->level,
                "status"=> $ebook->status,
                "sample_token"=> $ebook->sample_token,
                "token"=> $ebook->token,
                "createdAt"=>$ebook->created_at,
                "updatedAt"=> $ebook->updatetd_at
            ];
            return Rest::success('Ebook fetched.', $data);
        }catch(\Exception $e){
            return Rest::error($e);
        }
    }


    public function store(Request $r){
        try{
            $access=new ApiRequest(new EbookRequest(),[
                'user'=>auth('api')->user()->id
            ]);
            if($access::validate($r)['code']){
                $msg="Success Store";
                $this->obj->user = auth('api')->id();
                $this->obj->title = $r->input('title');
                $this->obj->token = Str::random(191);
                $this->obj->sample_token = Str::random(191);
                if($r->hasFile('cover') && !is_null($r->file('cover'))){
                    $cover= Storage::put('ebooks/'.auth('api')->user()->uuid.'/cover', $r->cover);
                    $this->obj->cover =getHashName($cover);
                }
                if($r->hasFile('file') && !is_null($r->file('file'))){
                    $first_pdf=Storage::put('ebooks/',$r->file);
                }
                if($r->hasFile('sample') && !is_null($r->file('sample'))){
                    $first_sample=Storage::put('ebooks/',$r->sample);
                }
                $this->obj->introduction = $r->input('introduction');
                $this->obj->description = $r->input('description');
                $this->obj->isbn = $r->input('isbn');
                $this->obj->year = ($r->has('year')) ? $r->input('year'): null;
                $this->obj->level = $r->input('level');
                $this->obj->save();
                $category = Category::findUUID($r->input('category'));
                $this->obj->categories()->syncWithoutDetaching($category['id']);
                if($r->has('tags')) {
                    $tags = explode('-', $r->input('tags'));
                    foreach ($tags as $tag) {
                        $result=Tag::whereName($tag)->first();
                        if($result===null){
                            $tag = Tag::create([
                                'uuid' => Str::uuid(),
                                'name' => rtrim(ltrim($tag))
                            ]);
                        }else{
                            $tag=Tag::whereName($tag)->firstOrFail();
                        }

                        $this->obj->tags()->syncWithoutDetaching($tag['id']);
                    }
                }
                AddPublisher::dispatch($this->obj, $r->input('publisher'));
                AddWriter::dispatch($this->obj, $r->input('writer'));
                    if($r->hasFile('sample')){
                        $sampleToken = $this->obj['sample_token'];
                        $sample = new Mpdf(['mode' => 'utf-8', 'tempDir' => storage_path('tmp')]);
                        $samplePath = storage_path($first_sample);
                        $sampleSource=$sample->setSourceFile($samplePath);
                        for ($s = 1; $s <= ($sampleSource); $s++) {
                            $sample->AddPage();
                            $sample->SetDisplayMode('fullpage', 'single');
                            $importSample = $sample->ImportPage($s);
                            $sample->SetWatermarkImage(public_path('logo.png'), 0.05, 'F', 'F');
                            $sample->showWatermarkImage = true;
                            $sizeSample = $sample->getTemplateSize($importSample);
                            $sample->useTemplate($importSample, 0, 0, $sizeSample['width'], $sizeSample['height'], true);
                        }
                        $sample->SetProtection(array(), $sampleToken, 'milad' . $sampleToken, 128);
                        $sample->Output($samplePath);
                        $sample = Storage::put('/', new File($samplePath));
                        Storage::delete($first_sample);

                        $this->obj->update([
                            'sample' => $sample
                        ]);
                    }
                    if($r->hasFile('file')){
                        $token = $this->obj['token'];
                        $pdf = new Mpdf(['mode' => 'utf-8', 'tempDir' => storage_path('tmp')]);
                        $filePath = storage_path($first_pdf);
                        $pdfSource = $pdf->setSourceFile($filePath);
                        for ($i = 1; $i <= ($pdfSource); $i++) {
                            $pdf->AddPage();
                            $pdf->SetDisplayMode('fullpage', 'single');
                            $importPage = $pdf->ImportPage($i);
                            $pdf->SetWatermarkImage(public_path('logo.png'), 0.05, 'F', 'F');
                            $pdf->showWatermarkImage = true;
                            $size = $pdf->getTemplateSize($importPage);
                            $pdf->useTemplate($importPage, 0, 0, $size['width'], $size['height'], true);
                        }
                        $pdf->SetProtection(array(), $token, 'milad' . $token, 128);
                        $pdf->Output($filePath);
                        $pdf = Storage::put('/', new File($filePath));
                        Storage::delete($first_pdf);
                        $this->obj->update([
                            'file' => $pdf,
                        ]);
                    }
                return Rest::success($msg, null);
            }
            $msg="Error Store";
            return Rest::badRequest($msg, $access::validate($r)['message']);
        }catch (\Exception $e){
            return Rest::badRequest();
        }
    }



    public function update(Request $r){
        try{
            $msg='Ebook Updated.';
            return Rest::success($msg, null);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }


    public function destroy($uuid){
        try{
            $msg='Ebook Deleted.';
            $item=$this->obj->me()->whereUuid($uuid)->with('transactions')->firstOrFail();
            if(count($item->transactions) > 0){
               return Rest::badRequest();
            }
            $this->obj->findUUID($uuid)->delete();
            return Rest::success($msg, null);
        }catch (\Exception $e){
            return Rest::error($e);

        }
    }

}