<?php

namespace Services\Attachment\Repositories;

use App\Repository\IRepository;
use Services\Attachment\Models\Attachment;
use Illuminate\Http\Request;

/**
 * Category
 * @author Sajadweb
 * Fri Dec 25 2020 02:37:20 GMT+0330 (Iran Standard Time)
 */
interface IAttachmentRepository extends IRepository
{
    public function upload(Request $request);
}
