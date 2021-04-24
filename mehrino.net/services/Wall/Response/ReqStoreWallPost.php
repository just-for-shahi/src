<?php

namespace Services\Wall\Response;

use Services\Swagger\Galleries;

/**
 * @OA\Schema(
 *     title="ReqStoreWall",
 *     description="ReqStoreWall",
 *     type="object"
 * )
 */
class ReqStoreWallPost
{
    use Galleries;
    /**
     * @OA\Property(
     *      title="wall",
     *      description="wall",
     *      format="UUID",
     *      example="099ab02d-ab5a-43f7-8eb3-b9aa2484cf1e"
     * )
     *
     * @var string
     */
    public $wall;
    /**
     * @OA\Property(
     *      title="institutes",
     *      description="institutes",
     *      format="UUID",
     *      example="099ab02d-ab5a-43f7-8eb3-b9aa2484cf1e"
     * )
     *
     * @var string
     */
    public $institutes;

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
     *     description="Item image",
     *     property="galleries[]",
     *     type="array",
     *     @OA\Items(type="file", format="binary")
     *)
     */
    public $galleries;


    /**
     * @OA\Property(
     *      title="latitude",
     *      description="latitude of coordination",
     *      example="32.4279"
     * )
     *
     * @var string
     */
    public $latitude;

    /**
     * @OA\Property(
     *      title="longitude",
     *      description="longitude of coordination",
     *      example="53.6880"
     * )
     *
     * @var string
     */
    public $longitude;


}
