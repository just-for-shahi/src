<?php

namespace Services\Attachment\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Attachment\Repositories\IAttachmentRepository;

/**
 * Category
 * @author Sajadweb
 * Fri Dec 25 2020 02:37:20 GMT+0330 (Iran Standard Time)
 */
class PanelAttachmentController extends Controller
{

    private $repository;

    public function __construct(IAttachmentRepository $repository)
    {
        \Auth::shouldUse('web');
        $this->repository = $repository;
    }

    public function destroy($uuid)
    {
        try {

            if ($this->repository->destroy($uuid)) {
                alert(__('message.delete.title'), __('message.delete.success'), 'success');
            } else {
                alert(__('message.delete.title'), __('message.delete.error'), 'error');
            }
            return back();
        } catch (\Exception $exp) {
            notifyException($exp);
            alert(__('message.delete'), __('message.delete.error'), 'error');
            return back();
        }
    }
}
