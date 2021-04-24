<?php


namespace App\Http\Controllers\CallRequest;


use App\Enums\CallRequest\Status;
use App\Scripts\Helpers\ValidationHelper;
use Illuminate\Http\Request;

class Controller extends \App\Http\Controllers\Controller
{

    private $model;

    public function __construct()
    {
        $this->model = new CallRequest();
    }

    public function index()
    {
        $page_title = 'Call Requests';
        $page_description = 'You own your consulting.';
        $items = CallRequest::me()->with('account')->latest()->get();

        return view('call-requests.index', compact('page_title', 'page_description', 'items'));
    }

    public function store(Request $r)
    {
        $r->validate([
            'name' => ValidationHelper::get('STRING'),
            'phone' => nope()->digitsBetween(10, 15)->toString(1),
            'back' => ValidationHelper::get('string', false)
        ]);

        $back = $r->input('back');
        $this->model->account_id = auth()->id();
        $this->model->name = $r->input('name');
        $this->model->phone = $r->input('phone');
        $this->model->save();
        if ($back != null) {
            return redirect($back);
        }

        return redirect()->route('callRequests.index');
    }

    public function cancel($uuid)
    {
        $model = $this->model->uuid($uuid)->firstOrFail();
        if ($model->account_id != auth()->id()) {
            return back();
        }

        $model->update([
            'status' => Status::CANCELED
        ]);

        return redirect()->route('callRequests.index');

    }
}
