<?php


namespace Services\Project\Controllers;


use App\Enums\ResponseCode;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Attachment;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Services\Category\Models\Category;
use Services\Institute\Models\Institute;
use Services\Project\Models\Project;
use Services\Project\Repositories\IProjectRepository;
use Services\User\Repositories\IUserRepository;

class PanelController
{
    private $model;
    private $repository;
    private $user;

    public function __construct(IProjectRepository $repository, IUserRepository $user)
    {
        setGuardWeb();
        $this->repository = $repository;
        $this->user = $user;
        $this->model = new Project();
    }

    public function index()
    {
        try {
            if (auth('web')->user()->role != 0)
                $items = Project::latest()->paginate(15);
            else
                $items = Project::me('web')->latest()->paginate(15);
            return view('views::projects.index', compact('items'));
        } catch (\Exception $e) {
            return abort(ResponseCode::Error);
        }
    }

    public function create()
    {
        try {
            $categories = Category::all();
            $institutes = Institute::me('web')->latest()->get();
            return view('views::projects.create', compact('categories', 'institutes'));
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
            return abort(ResponseCode::Error);
        }
    }

    public function store(StoreProjectRequest $r)
    {
        try {
            $date = date('Y-m');
            if (auth('web')->user()->role != 0)
                $usr = $this->user->findInsert($r->input('user'));
            else
                $usr = auth('web')->user();

            $this->model->user = $usr->id;
            $this->model->institutes = $r->input('institutes', null);
            $this->model->title = $r->input('title');
            $this->model->cover = $r->file('cover')->store($date);
            if ($r->hasFile('cover')) {
                $this->model->cover = $r->file('cover')->store(uploadPath("projects/" .  $usr->uuid));
                $this->model->cover && imageOnQueue($this->model->cover);
            }
            $this->model->content = $r->input('content');
            $this->model->latitude = $r->input('latitude');
            $this->model->longitude = $r->input('longitude');
            $this->model->status = $r->input('status',1);
            $this->model->target = $r->input('target');
            $this->model->save();
            if ($r->hasFile('files')) {
                foreach ($r->file('files') as $file) {
                    $path =  $file->store(uploadPath("gallery/" . $usr->uuid));
                    imageOnQueue($path);
                    Attachment::create([
                        'user' => $usr->id,
                        'path' => $path,
                        'attachable_id' => $this->model['id'],
                        'attachable_type' => Project::class
                    ]);
                }
            }
            $this->model->saveStatus(auth()->id(),$r->input('status',1));
            return redirect()->route('panel.projects');
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
            dd($e);
            return abort(ResponseCode::Error);
        }
    }

    public function show($uuid)
    {
        try {

            $project = $this->repository->findUuid($uuid);
            if ($project === null) {
                return abort(404);
            }
            $institutes = Institute::me('web')->latest()->get();
            return view('views::projects.show', [
                'project' => $project,
                'institutes' => $institutes
            ]);
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
            return abort(500);
        }
    }

    public function updated($uuid, UpdateProjectRequest $r)
    {
        try {
            if (auth('web')->user()->role != 0)
                $usr = $this->user->findInsert($r->input('user'));
            else
                $usr = auth('web')->user();
            if ($usr === null) {
                return redirect()->back();
            }
            $this->model = $this->model->where(['uuid' => $uuid, 'user' =>  $usr->id])->first();
            if ($this->model === null) {
                return redirect()->back();
            }
            $data = [
                'title' => $r->input('title'),
                'institutes' => $r->input('institutes', null),
                'target' => $r->input('target'),
                'status' => $r->input('status',1),
                'content' => $r->input('content'),
                'latitude' => $r->input('latitude'),
                'longitude' => $r->input('longitude'),
            ];
            if ($r->hasFile('cover')) {
                $this->model->cover && deleteAll($this->model->cover);
                $data['cover']  = $r->file('cover')->store(uploadPath("projects/" .  $usr->uuid));
                $data['cover']  && imageOnQueue($data['cover']);
            }
            $this->model->update($data);
            if ($r->hasFile('files')) {
                foreach ($r->file('files') as $file) {
                    $path =  $file->store(uploadPath("gallery/" . $usr->uuid));
                    imageOnQueue($path);
                    Attachment::create([
                        'user' => $usr->id,
                        'path' => $path,
                        'attachable_id' => $this->model['id'],
                        'attachable_type' => Project::class
                    ]);
                }
            }
            return redirect()->route('panel.projects');
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
            return $e->getMessage();

            return abort(500);
        }
    }

    public function destroy($uuid)
    {
        try {
            if (auth('web')->user()->role != 0)
                $where = ['uuid' => $uuid];
            else
                $where = ['uuid' => $uuid, 'user' => auth()->id()];
            $this->model = $this->model->where($where)->first();
            if ($this->model === null) {
                return redirect()->back();
            }
            $this->model->delete();
            alert(__('message.delete.title'), __('message.delete.success'), 'success');
            return back();
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
            alert(__('message.delete.title'), __('message.delete.error'), 'error');
            return back();
        }
    }
}
