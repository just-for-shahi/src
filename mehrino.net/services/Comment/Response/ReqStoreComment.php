<?php

namespace Services\Comment\Response;

/**
 * @OA\Schema(
 *     title="ReqStoreComment",
 *     description="ReqStoreComment",
 *     type="object"
 * )
 */
class ReqStoreComment
{
    /**
     * @OA\Property(
     *      title="comment",
     *      description="comment string",
     *      example="Hello world !!!"
     * )
     *
     * @var string
     */
    public $comment;
}
