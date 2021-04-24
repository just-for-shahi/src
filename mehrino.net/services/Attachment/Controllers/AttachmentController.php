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
class AttachmentController extends Controller
{

    private $repository;

    public function __construct(IAttachmentRepository $repository)
    {
        // todo add repo
        $this->repository = $repository;
    }

    public function destroy($uuid)
    {
        try {
            if($this->repository->destroy($uuid))
                return Ok();
            return NotFound404();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function gallery(Request $request)
    {
        try {
            $create = $this->repository->upload($request);
            if($create){
                imageDeleteOnQueue($create);
                return Created201([
                    "uuid"=>$create->uuid,
                    "path"=>getBaseUri($create->path)
                ]);
            }
            return NotFound404();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }
    public function test1()
    {
        try {
             imageOnQueue('2021-02/profile/oabHYt1EZZ2ySNUbH6ikMvz3GjLWCLaxA3bxKwan.jpg');
             return 1;
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }
    public function test2()
    {
        try {
            return upload('2021-02/profile/TUUoYg43iRYBHA58nJfkl3Gc3jKoJUIFu4ISaqDY.png');
             return 2;
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }
}
