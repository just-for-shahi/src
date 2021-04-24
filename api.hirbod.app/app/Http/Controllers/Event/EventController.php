<?php


namespace App\Http\Controllers\Event;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{

    private $entity;
    private $entityRegistration;


    public function __construct()
    {
        $this->entity = new Event();
        $this->entityRegistration = new EventRegistration();
    }

    public function index(){
        return view('event.list', ['events' => Event::latest()->paginate(15)]);
    }

    public function create(){
        return view('event.create', ['categories' => Category::where('type', 3)->get()]);
    }

    public function store(Request $request){
        $date = date('Y-m');
        $this->entity = Event::create([
            'user' => auth()->id(),
            'code' => Str::random(6),
            'title' => $request->input('title'),
            'location' => $request->input('location'),
            'introduction' => $request->input('introduction'),
            'cover' => Storage::disk('liara')->put($date.'/events', $request->file('cover')),
            'live' => 1,
            'video' => 1,
            'dedicated' => 1,
            'type' => 0
        ]);
        $this->entity->categories()->sync($request->input('category'), false);
        $tags = explode('-', $request->input('tags'));
        foreach ($tags as $tag){
            $tag = Tag::updateOrCreate([
                'name' => rtrim(ltrim($tag))
            ]);
            $this->entity->tags()->sync($tag->id, false);
        }
        foreach ($request->input('faq-question') as $key => $value) {
            EventFaq::create([
                'event' => $this->entity->id,
                'question' => $request->input('faq-question')[$key],
                'answer' => $request->input('faq-answer')[$key]
            ]);
        }
        foreach ($request->input('organizer-name') as $key => $value) {
            EventOrganizer::create([
                'event' => $this->entity->id,
                'name' => $request->input('organizer-name')[$key],
                'logo' => Storage::disk('liara')->put($date.'/events/organizer/', $request->file('organizer-logo')[$key]),
                'website' => $request->input('organizer-website')[$key],
                'instagram' => $request->input('organizer-instagram')[$key],
                'telegram' => $request->input('organizer-telegram')[$key],
            ]);
        }
        foreach ($request->input('scheduling-title') as $key => $value) {
            if ($request->has('scheduling-title')[$key] && $request->input('scheduling-title')[$key] != "" && $request->input('scheduling-title')[$key] != null){
                    EventScheduling::create([
                    'event' => $this->entity->id,
                    'title' => $request->input('scheduling-title')[$key],
                    'from' => $request->input('scheduling-from')[$key],
                    'till' => $request->input('scheduling-till')[$key]
                ]);
            }
        }
        foreach ($request->input('speakers-name') as $key => $value) {
            EventSpeaker::create([
                'event' => $this->entity->id,
                'name' => $request->input('speakers-name')[$key],
                'avatar' => Storage::disk('liara')->put($date.'/events/speakers/', $request->file('speakers-avatar')[$key]),
                'bio' => $request->input('speakers-bio')[$key],
                'website' => $request->input('speakers-website')[$key],
                'instagram' => $request->input('speakers-instagram')[$key],
                'telegram' => $request->input('speakers-telegram')[$key]
            ]);
        }
        foreach ($request->input('sponsors-name') as $key => $value) {
            if ($request->has('sponsors-name')[$key] && $request->input('sponsors-name')[$key] != "" && $request->input('sponsors-name')[$key] != null){
                    EventSponsor::create([
                    'event' => $this->entity->id,
                    'name' => $request->input('sponsors-name')[$key],
                    'logo' => Storage::disk('liara')->put($date . '/events/sponsors/', $request->file('sponsors-logo')[$key]),
                    'website' => $request->input('sponsors-website')[$key],
                    'instagram' => $request->input('sponsors-instagram')[$key],
                    'telegram' => $request->input('sponsors-telegram')[$key],
                ]);
            }
        }
        return redirect()->route('events.index');
    }

}