<?php

namespace Services\Wall\Response;

use Services\Swagger\Galleries;

/**
 * @OA\Schema(
 *     title="ReqUpdateWall",
 *     description="ReqUpdateWall",
 *     type="object"
 * )
 */
class ReqUpdateWall
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
     *      title="description",
     *      description="description string",
     *      example="Hello world! :)"
     * )
     *
     * @var string
     */
    public $description;

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

    /**
     * @OA\Property(
     *      title="private",
     *      description="private bool",
     *      example="0"
     * )
     *
     * @var string
     */
    public $private;

}
