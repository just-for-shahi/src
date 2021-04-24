<?php

namespace Services\Attachment\Response;


/**
 * @OA\Schema(
 *     title="ReqGallery",
 *     description="ReqGallery",
 *     type="object"
 * )
 */
class ReqGallery
{

    /**
     * @OA\Property(
     *      title="file",
     *      description="file",
     *      type="file",
     *      format="binary"
     * )
     */
    public $file;
}
