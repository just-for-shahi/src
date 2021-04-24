<?php

namespace Services\Like\Response;

/**
 * @OA\Schema(
 *     title="ReqStoreLike",
 *     description="ReqStoreLike",
 *     type="object"
 * )
 */
class ReqStoreLike
{
    /**
     * @OA\Property(
     *      title="action",
     *      description="action like or dislike",
     *      example="like"
     * )
     *
     * @var string
     */
    public $action;
}
