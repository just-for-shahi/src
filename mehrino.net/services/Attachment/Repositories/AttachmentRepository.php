<?php

namespace Services\Attachment\Repositories;

use Services\Attachment\Models\Attachment;
use App\Repository\Repository;
use Illuminate\Http\Request;

/**
 * Category
 * @author Sajadweb
 * Fri Dec 25 2020 02:37:20 GMT+0330 (Iran Standard Time)
 */
class AttachmentRepository extends Repository implements IAttachmentRepository
{
    /**
     * The model being queried.
     *
     * @var Attachment
     */
    public $model;

    public function __construct(Attachment $model)
    {
        $this->model = new $model();
    }

    public function destroy($uuid)
    {
        try {
            $where = [
                'uuid' => $uuid
            ];
            if (!role('admin'))
                $where['user'] = auth()->user()->id;
            return $this->model->where($where)->delete();
        } catch (\Exception $exp) {
            return false;
        }
    }

    public function upload(Request $request)
    {
        $path =  $request->file('file')->store(uploadPath("gallery/" . auth()->user()->uuid));
        imageOnQueue($path);
        return $this->model->create([
            'path' => $path,
            'user' => auth()->id(),
            'attachable_type' => User::class,
            'attachable_id' => auth()->id()
        ]);
    }
}
