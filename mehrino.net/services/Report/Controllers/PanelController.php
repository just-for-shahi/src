<?php

namespace Services\Report\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Attachment\Models\Attachment;
use Services\Project\Repositories\IProjectRepository;
use Services\Report\Models\Report;
use Services\Report\Repositories\IReportRepository;
use Services\Report\Requests\StoreReportRequest;
use Services\Report\Requests\UpdateReportRequest;
use Services\Voluntary\Repositories\IVoluntaryWorkRepository;

/**
 * Report
 * @author Sajadweb
 * Mon Jan 11 2021 21:18:28 GMT+0330 (Iran Standard Time)
 */
class PanelController extends Controller
{

    private $repository;
    private $project;
    private $voluntary;
    public function __construct(
        IProjectRepository $project,
        IVoluntaryWorkRepository $voluntary,
        IReportRepository $repository
    ) {
        setGuardWeb();
        $this->repository = $repository;
        $this->voluntary = $voluntary;
        $this->project = $project;
    }

    public function index($service, $uuid)
    {
        try {
            if (!in_array($service, getReportName())) {
                error();
                return back();
            }

            $project = $this->{$service}->db()->where('uuid', $uuid)->first();
            if (!$project) {
                error();
                return abort(404);
            }
            $items = $this->repository->paginateWithService($project, x_count(), x_page());
            return view('views::report.index', compact('items', 'project'));
        } catch (\Exception $exp) {
            notifyException($exp);
            return back();
        }
    }
    public function create($service, $uuid)
    {
        try {
            if (!in_array($service, getReportName())) {
                error();
                return back();
            }
            $item = $this->{$service}->db()->where('uuid', $uuid)->first();
            if (!$item) {
                error();
                return abort(404);
            }
            return view('views::report.create', compact('service', 'item'));
        } catch (\Exception $exp) {
            notifyException($exp);
            return back();
        }
    }

    public function store(StoreReportRequest $request, $service, $uuid)
    {
        try {
            if (!in_array($service, getReportName())) {
                error();
                return back();
            }
            $service = $this->{$service}->db()->where('uuid', $uuid)->first();
            if (!$service) {
                error();
                return back();
            }

            $usr = auth()->user();
            $report = $this->repository->saved($request, $service);
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $path =  $file->store(uploadPath("gallery/" . $usr->uuid));
                    imageOnQueue($path);
                    Attachment::create([
                        'user' => $usr->id,
                        'path' => $path,
                        'attachable_id' => $report->id,
                        'attachable_type' => Report::class
                    ]);
                }
            }
            success("گزارش", "ثبت");
            return back();
        } catch (\Exception $exp) {
            notifyException($exp);
            return back();
        }
    }
    public function show($service, $uuid, $id)
    {
        try {
            if (!in_array($service, getReportName())) {
                error();
                return back();
            }
            $item = $this->{$service}->db()->where('uuid', $uuid)->first();
            if (!$item) {
                error();
                return abort(404);
            }
            $report = $this->repository->db()->where('uuid', $id)->first();
            if (!$report) {
                error();
                return abort(404);
            }
            return view('views::report.show', compact('service', 'item', 'report'));
        } catch (\Exception $exp) {
            error();
            notifyException($exp);
            return back();
        }
    }

    public function updated(UpdateReportRequest $request, $service, $uuid, $id)
    {
        try {
            if (!in_array($service, getReportName())) {
                error();
                return back();
            }
            $item = $this->{$service}->db()->where('uuid', $uuid)->first();
            if (!$item) {
                error();
                return back();
            }
            $report = $this->repository->db()->where('uuid', $id)->first();
            if (!$report) {
                error();
                return back();
            }
            $data = $request->only(['title', 'content','status']);
            if ($request->hasFile('cover')) {
                $data['cover'] = $request->file('cover')->store(uploadPath("report/" . auth()->user()->uuid));
                $data['cover']  && imageOnQueue($data['cover']);
            }
            $usr = auth()->user();
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $path =  $file->store(uploadPath("gallery/" . $usr->uuid));
                    imageOnQueue($path);
                    Attachment::create([
                        'user' => $usr->id,
                        'path' => $path,
                        'attachable_id' => $report->id,
                        'attachable_type' => Report::class
                    ]);
                }
            }
            $report->update($data);
            success("گزارش", "ویرایش");
            return back();
        } catch (\Exception $exp) {
            error();
            notifyException($exp);
            return back();
        }
    }
}
