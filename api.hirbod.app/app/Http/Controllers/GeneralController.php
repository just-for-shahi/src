<?php


namespace App\Http\Controllers;


use App\Events\SearchEvent;
use App\Facades\HResponse\HResponse;
use App\Facades\Rest\Rest;
use App\Http\Controllers\Account\User;
use App\Http\Controllers\Course\Course;
use App\Http\Controllers\EBook\EBook;
use App\Http\Controllers\Event\Event;
use App\Http\Controllers\Podcast\Podcast;
use App\Http\Controllers\Story\Story;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GeneralController extends Controller
{

    /*
    * type [story,slider,event,course,ebook,podcast,category,tag,user,url]
    *
    */



    public function home(){
        try{
            $msg='Home fetched.';
            $tags = Tag::latest()->take(9)->get();
            $courses = Course::latest()->take(9)->get();
            $categories = Category::latest()->take(9)->get();
            $podcasts= HResponse::podcasts(Podcast::latest()->take(9)->get());
            $books = EBook::latest()->take(9)->get();
            $events = Event::latest()->with(['speakers', 'prices','categories','tags','user'])->take(9)->get();
//            $stories = Story::latest()->with(['user'])->take(9)->get();
            $stories = User::has('stories')
                ->with(['stories','stories.visits','stories.likes'])
                ->orderByDesc(
                    Story::select('created_at')
                        ->whereColumn('user', 'users.id')
                        ->orderByDesc('created_at')
                        ->limit(1)
                )
                ->take(9)
                ->get();

//            $events=[];
//            foreach ($eventsData as $event){
//                $speakers = [];
//                if ($event->speakers()->count() > 0) {
//                    foreach ($event->speakers as $speaker){
//                        $speakers[] = [
//                            'id' => $speaker->id,
//                            'name' => $speaker->name,
//                            'telegram' => $speaker->telegram,
//                            'instagram' => $speaker->instagram,
//                            'website' => $speaker->website,
//                            'bio' => $speaker->bio,
//                            'avatar' => Rest::$SARA.$speaker->avatar
//                        ];
//                    }
//                }
//
//                if ($event->prices()->count() > 0) {
//                    $price = $event->prices[0]->price;
//                } else {
//                    $price = 0;
//                }
////                $price = (is_null($event->prices) ? 0 : $event->prices[0]->price);
//                $events[] = [
//                    'type' => 2,
//                    'cover' => Rest::$SARA.$event->cover,
//                    'title' => $event->title,
//                    'price' => intval($price),
//                    'location' => $event->location
//                ];
//            }

            $slider = [
                [
                    'type' => 8,
                    'content' => "https://hirbod.ac/plus/",
                    'photo' => 'https://s.hirbod.ac/static/plus.png',
                ],
                [
                    'type' => 8,
                    'content' => "https://hirbod.ac/referrer/",
                    'photo' => 'https://s.hirbod.ac/static/friends.png'
                ]
            ];
            $data = [
                [
                    'type' => 0,
                    'title' => 'Stories',
                    'items' => (is_null($stories) ? null:HResponse::stories($stories))
                ],
                [
                    'type' => 1,
                    'title' => 'Slider',
                    'items' => (is_null($slider) ? null:$slider)
                ],

                [
                    'type' => 2,
                    'title' => 'رویدادهای آموزشی',
                    'items' => (is_null($events) ? null:HResponse::events($events))
                ],
                [
                    'type' => 3,
                    'title' => 'دوره های آموزشی',
                    'items' => (is_null($courses) ? null:HResponse::courses($courses))
                ],
                [
                    'type' => 4,
                    'title' => 'باهم میخوانیم',
                    'items' => ($books === null ? null:HResponse::ebooks($books))
                ],
                [
                    'type' => 5,
                    'title' => 'پادکست',
                    'items' => (is_null($podcasts) ? null:$podcasts)
                ],
//                [
//                    'type' => 6,
//                    'title' => 'دسته بندی ها',
//                    'items' => (is_null($categories) ? null:HResponse::categories($categories))
//                ],
                [
                    'type' => 7,
                    'title' => 'داغ ترین ها',
                    'items' => (is_null($tags) ? null:HResponse::tags($tags))
                ]
            ];
            return Rest::success($msg,$data);
        }catch(\Exception $e){
            return Rest::error($e);
        }
    }

    public function search(Request $request){

        try {
            $msg = 'Search Fetched.';
            $q = $request->input('q');
//           \event(new SearchEvent($q));
            $events = Event::where('title', 'LIKE', "%".$q."%")->get();
            $ebooks = EBook::where('title', 'LIKE', "%".$q."%")->get();
            $podcasts= Podcast::where('title', 'LIKE',"%".$q."%")->get();
            $courses = Course::where('title', 'LIKE', "%".$q."%")->get();
            $data = [
                'courses' => (is_null($courses) ? null:$courses->makeHidden('id')),
                'ebooks' => (is_null($ebooks) ? null:$ebooks->makeHidden('id')),
                'events' => (is_null($events) ? null:HResponse::events($events)),
                'podcasts' => (is_null($podcasts) ? null:$podcasts->makeHidden('id'))
            ];
            return Rest::success($msg,$data);
        } catch (\Exception $exception) {
            return Rest::error($exception);
        }

    }
    public function courses(){

        try {
            $msg='Courses Fetched.';
            $courses = Course::latest()->get();
            $data=(is_null($courses) ? null : $courses->makeHidden('id'));
            return Rest::success($msg,$data);
        } catch (\Exception $exception) {
          return Rest::error($exception);
        }

    }

    public function events(){

        try {
            $msg='Events Fetched';
            $eventsData = Event::latest()->with(['speakers', 'prices'])->get();
            $events=[];
            foreach ($eventsData as $event){
                $speakers = [];
                foreach ($event->speakers as $speaker){
                    $speakers[] = [
                        'id' => $speaker->id,
                        'name' => $speaker->name,
                        'telegram' => $speaker->telegram,
                        'instagram' => $speaker->instagram,
                        'website' => $speaker->website,
                        'bio' => $speaker->bio,
                        'avatar' => Rest::$SARA.$speaker->avatar
                    ];
                }

                $price = (is_null($event->prices) ? 0 : $event->prices[0]->price);

                $events[] = [
                    'type' => 2,
                    'cover' => Rest::$SARA.$event->cover,
                    'title' => $event->title,
                    'price' => intval($price),
                    'location' => $event->location,
                    'speakers'=>$speakers
                ];
            }
            $data=(is_null($events) ? null : $events->makeHidden('id'));
            return Rest::success($msg,$data);
        } catch (\Exception $exception) {
          return Rest::error($exception);

        }

    }
    public function ebooks(){

        try {
            $msg='Ebooks Fetched.';
            $ebooks = EBook::with('prices')->get();
            return Rest::success($msg,HResponse::ebooks($ebooks));
        } catch (\Exception $exception) {
            return dd($exception->getMessage());
        }

    }

}