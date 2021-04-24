<?php

namespace Services\Report\Repositories;

use Services\Report\Models\Report;
use App\Repository\Repository;
use Services\Attachment\Repositories\IAttachmentRepository;

/**
 * Report
 * @author Sajadweb
 * Mon Jan 11 2021 21:18:28 GMT+0330 (Iran Standard Time)
 */
class ReportRepository extends Repository implements IReportRepository
{
    /**
     * The model being queried.
     *
     * @var Report
     */
    public $model;
    public $attachment;

    public function __construct(Report $model, IAttachmentRepository $attachment)
    {
        $this->model = new $model();
        $this->attachment = $attachment;
    }


    public function saved($request, $service)
    {
        $data = $request->only(['title', 'content']);
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store(uploadPath("report/" . auth()->user()->uuid));
            imageOnQueue($data['cover']);
        }
        if ($request->has('status')) {
            $data['status'] = $request->input('status',0);
        }
        $data['institutes'] = $request->input('institutes');
        $data['user'] = auth()->id();
        $report = $service->saveReport($data);
        if ($report) {
            if ($request->has('galleries')) {
                $galleries = collect($request->input('galleries'));
                $this->attachment->db()
                    ->whereIn('uuid',  $galleries)
                    ->me()
                    ->update([
                        'attachable_type' => Report::class,
                        'attachable_id' => $report->id,
                    ]);
            }
        }
        return $report;
    }

    public function mapper($res)
    {
        $data = [];
        foreach ($res as $item) {
            $user = $item->user()->first(['uuid', 'name', 'avatar']);
            $user->avatar = getBaseUri($user->avatar);
            $data[] = [
                'title' => $item->title,
                'content' => $item->content,
                'cover' => getBaseUri($item->cover),
                'galleries' => collect($item->attachments)->map(function ($item) {
                    return getBaseUri($item->path);
                })->all(),
                'user' => $user,
                'createdAt' => $item->created_at,
            ];
        }
        return $data;
    }

    public function paginateWithService($service, int $count = 15, int $page = 1, array $columns = ['*'])
    {
        return $service->reports()
            ->with(['attachments', 'user'])
            ->orderBy('id', 'desc')
            ->paginate($count, $columns, $pageName = null, $page);
    }
}
