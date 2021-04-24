<?php

namespace Services\Wall\Response;

use Services\Swagger\Galleries;

/**
 * @OA\Schema(
 *     title="ReqUpdateWallPost",
 *     description="ReqUpdateWallPost",
 *     type="object"
 * )
 */
class ReqUpdateWallPost
{
    use Galleries;
    /**
     * @OA\Property(
     *      title="title",
     *      description="title string",
     *      example="Hello world!"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="cover",
     *      description="cover image",
     *      type="file",
     *      format="binary"
     * )
     *
     * @var string
     */
    public $cover;

    /**
     * @OA\Property(
     *      title="content",
     *      description="content string",
     *      example="Hello world! :)"
     * )
     *
     * @var string
     */
    public $content;
    /**
     * @OA\Property(
     *      title="type",
     *      description="type",
     *      example="0"
     * )
     *
     * @var string
     */
    public $type;


}
